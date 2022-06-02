<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\ConfigurationCommonInterface;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Models\ThemeInterface;
use App\Ship\Parents\Repositories\ConfigurationCommonRepositoryInterface;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Storage;

class FindTemplatesTask extends Task implements FindTemplatesTaskInterface
{
    public function __construct(
        private ConfigurationCommonRepositoryInterface $configurationCommonRepository,
        private ThemeRepositoryInterface               $themeRepository,
        private TemplateRepositoryInterface            $templateRepository
    )
    {
    }

    /**
     * @param int $languageId
     * @param int $pageId
     * @return \App\Ship\Parents\Dto\ThemeDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $languageId, int $pageId): ThemeDto
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\ThemeInterface $theme
             * @var ConfigurationCommonInterface|null       $defaultTheme
             */
            $defaultTheme = $this->configurationCommonRepository->findByField('config', ConfigurationCommonInterface::DEFAULT_THEME)->first();
            $theme        = $this->themeRepository->findWhere(['id' => $defaultTheme->value, 'active' => true])->first();
            $template     = $this->templateRepository->findByThemeAndLanguage($theme->id, $languageId, $pageId);
            $templateDto  = $this->buildTemplateDto($theme, $template, $languageId);

            $baseTemplateId = $templateDto->get(TemplateInterface::PAGE_TYPE)?->getParentTemplateId();
            $baseTemplates  = $templateDto->get(TemplateInterface::BASE_TYPE);
            $baseTemplate   = is_null($baseTemplateId) ? $baseTemplates?->first() : $baseTemplates?->get($baseTemplateId);
            $templateDto->put(TemplateInterface::BASE_TYPE, $baseTemplate);

            return (new ThemeDto())
                ->setId($theme->id)
                ->setName($theme->name)
                ->setActive($theme->active)
                ->setTemplates($templateDto)
                ->setDirectory($theme->directory)
                ->setCreateAt($theme->created_at)
                ->setUpdateAt($theme->updated_at);

        } catch (Exception) {
            throw new NotFoundException();
        }
    }

    /**
     * @param \App\Ship\Parents\Models\ThemeInterface  $theme
     * @param \Illuminate\Database\Eloquent\Collection $templates
     * @param int                                      $languageId
     * @return \Illuminate\Support\Collection
     */
    private function buildTemplateDto(ThemeInterface $theme, Collection $templates, int $languageId): \Illuminate\Support\Collection
    {
        return $templates
            ->map(static function (TemplateInterface $template) use ($theme) {
                [$folder, $type] = match ($template->type) {
                    TemplateInterface::CSS_TYPE => [
                        config('constructor-template.folderName.css'),
                        config('constructor-template.fileType.css'),
                    ],
                    TemplateInterface::JS_TYPE => [
                        config('constructor-template.folderName.js'),
                        config('constructor-template.fileType.js'),
                    ],
                    default => [
                        config('constructor-template.folderName.view'),
                        config('constructor-template.fileType.view'),
                    ],
                };

                $commonFile  = implode('/', [$theme->directory, $folder, $template->common_filepath . $type]);
                $elementFile = implode('/', [$theme->directory, $folder, $template->element_filepath . $type]);
                $previewFile = implode('/', [$theme->directory, $folder, $template->preview_filepath . $type]);

                $storage     = Storage::disk('template');
                $commonHtml  = $storage->exists($commonFile) ? $storage->get($commonFile) : null;
                $elementHtml = $storage->exists($elementFile) ? $storage->get($elementFile) : null;
                $previewHtml = $storage->exists($previewFile) ? $storage->get($previewFile) : null;

                return (new TemplateDto())
                    ->setId($template->id)
                    ->setType($template->type)
                    ->setCommonFilepath($template->common_filepath)
                    ->setCommonHtml($commonHtml)
                    ->setElementFilepath($template->element_filepath)
                    ->setElementHtml($elementHtml)
                    ->setPreviewFilepath($template->preview_filepath)
                    ->setPreviewHtml($previewHtml)
                    ->setParentTemplateId($template->parent_template_id)
                    ->setLanguageId($template->language_id)
                    ->setThemeId($template->theme_id)
                    ->setPageId($template->page_id)
                    ->setCreateAt($template->created_at)
                    ->setUpdateAt($template->updated_at);
            })
            ->groupBy(fn(TemplateDto $templateDto) => $templateDto->getType())
            ->map(static function (\Illuminate\Support\Collection $template, string $type) use ($languageId) {
                $baseType   = TemplateInterface::BASE_TYPE;
                $pageType   = TemplateInterface::PAGE_TYPE;
                $menuType   = TemplateInterface::MENU_TYPE;
                $widgetType = TemplateInterface::WIDGET_TYPE;

                return match ($type) {
                    $pageType => $template->get($languageId) ?? $template->first(),
                    $baseType, $menuType, $widgetType => $template->keyBy(fn(TemplateDto $templateDto) => $templateDto->getId()),
                    default => $template->values()
                };
            });
    }
}

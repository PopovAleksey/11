<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class FindTemplatesTask extends Task implements FindTemplatesTaskInterface
{
    public function __construct(
        private ThemeRepositoryInterface    $themeRepository,
        private TemplateRepositoryInterface $templateRepository
    )
    {
    }

    /**
     * @param int $languageId
     * @return \App\Ship\Parents\Dto\ThemeDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $languageId): ThemeDto
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\ThemeInterface $theme
             */
            $theme       = $this->themeRepository->findWhere(['active' => true])->first();
            $template    = $this->templateRepository->findByThemeAndLanguage($theme->id, $languageId);
            $templateDto = $this->buildTemplateDto($template);

            return (new ThemeDto())
                ->setId($theme->id)
                ->setName($theme->name)
                ->setActive($theme->active)
                ->setTemplates($templateDto)
                ->setCreateAt($theme->created_at)
                ->setUpdateAt($theme->updated_at);

        } catch (Exception) {
            throw new NotFoundException();
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection $templates
     * @return \Illuminate\Support\Collection
     */
    private function buildTemplateDto(Collection $templates): \Illuminate\Support\Collection
    {
        return $templates
            ->map(static function (TemplateInterface $template) {
                return (new TemplateDto())
                    ->setId($template->id)
                    ->setType($template->type)
                    ->setCommonFilepath($template->common_filepath)
                    ->setElementFilepath($template->element_filepath)
                    ->setPreviewFilepath($template->preview_filepath)
                    ->setLanguageId($template->language_id)
                    ->setThemeId($template->theme_id)
                    ->setPageId($template->page_id)
                    ->setCreateAt($template->created_at)
                    ->setUpdateAt($template->updated_at);
            })
            ->groupBy(fn(TemplateDto $templateDto) => $templateDto->getType())
            ->mapWithKeys(fn(\Illuminate\Support\Collection $templates, $type) => $type === TemplateInterface::PAGE_TYPE ? $templates : $templates->first());
    }
}

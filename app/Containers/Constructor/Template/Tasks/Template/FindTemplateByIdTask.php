<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Dto\PageFieldDto;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\LanguageInterface;
use App\Ship\Parents\Models\PageFieldInterface;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Models\ThemeInterface;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Storage;

class FindTemplateByIdTask extends Task implements FindTemplateByIdTaskInterface
{
    public function __construct(
        private TemplateRepositoryInterface       $repository,
        private GetTemplatesFilepathTaskInterface $getTemplatesFilepathTask
    )
    {
    }

    /**
     * @param int $id
     * @return \App\Ship\Parents\Dto\TemplateDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $id): TemplateDto
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\TemplateInterface $template
             */
            $template = $this->repository->find($id);
            $theme    = $template->theme;
            $storage  = Storage::disk('template');

            [$commonFile, $elementFile, $previewFile] = $this->getTemplatesFilepathTask->run($template, $theme);
            
            $commonHtml  = $storage->exists($commonFile) ? $storage->get($commonFile) : null;
            $elementHtml = $storage->exists($elementFile) ? $storage->get($elementFile) : null;
            $previewHtml = $storage->exists($previewFile) ? $storage->get($previewFile) : null;

            return (new TemplateDto())
                ->setId($template->id)
                ->setName($template->name)
                ->setType($template->type)
                ->setPageId($template->page_id)
                ->setChildPageId($template->child_page_id)
                ->setThemeId($template->theme_id)
                ->setLanguageId($template->language_id)
                ->setTheme($this->buildThemeDto($theme))
                ->setPage($this->buildPageDto($template->page))
                ->setChildPage($this->buildPageDto($template->child_page))
                ->setLanguage($this->buildLanguageDto($template->language))
                ->setCommonFilepath($template->common_filepath)
                ->setCommonHtml($commonHtml)
                ->setElementFilepath($template->element_filepath)
                ->setElementHtml($elementHtml)
                ->setPreviewFilepath($template->preview_filepath)
                ->setPreviewHtml($previewHtml)
                ->setCreateAt($template->created_at)
                ->setUpdateAt($template->updated_at);

        } catch (Exception) {
            throw new NotFoundException();
        }
    }

    /**
     * @param \App\Ship\Parents\Models\ThemeInterface $theme
     * @return \App\Ship\Parents\Dto\ThemeDto
     */
    private function buildThemeDto(ThemeInterface $theme): ThemeDto
    {
        return (new ThemeDto())
            ->setId($theme->id)
            ->setName($theme->name)
            ->setDirectory($theme->directory)
            ->setActive($theme->active)
            ->setCreateAt($theme->created_at)
            ->setUpdateAt($theme->updated_at);
    }

    /**
     * @param \App\Ship\Parents\Models\PageInterface|null $page
     * @return \App\Ship\Parents\Dto\PageDto|null
     */
    private function buildPageDto(?PageInterface $page): ?PageDto
    {
        if ($page === null) {
            return null;
        }

        $fields = $page->fields->map(function (PageFieldInterface $pageField) use ($page) {
            return (new PageFieldDto())
                ->setId($pageField->id)
                ->setName($pageField->name)
                ->setActive($pageField->active)
                ->setType($pageField->type)
                ->setMask($pageField->mask)
                ->setPlaceholder($pageField->placeholder)
                ->setValues($pageField->values)
                ->setPageId($page->id)
                ->setCreateAt($pageField->created_at)
                ->setUpdateAt($pageField->updated_at);
        })->toArray();

        $pageDto = (new PageDto())
            ->setId($page->id)
            ->setName($page->name)
            ->setActive($page->active)
            ->setType($page->type)
            ->setFields($fields)
            ->setCreateAt($page->created_at)
            ->setUpdateAt($page->updated_at);

        if (
            $page->type === PageInterface::BLOG_TYPE &&
            $childPageDto = $this->buildPageDto($page->child_page)
        ) {
            $pageDto->setChildPage($childPageDto);
        }

        return $pageDto;
    }

    /**
     * @param \App\Ship\Parents\Models\LanguageInterface|null $language
     * @return \App\Ship\Parents\Dto\LanguageDto|null
     */
    private function buildLanguageDto(?LanguageInterface $language): ?LanguageDto
    {
        if ($language === null) {
            return null;
        }

        return (new LanguageDto())
            ->setId($language->id)
            ->setName($language->name)
            ->setShortName($language->short_name)
            ->setIsActive($language->active)
            ->setCreateAt($language->created_at)
            ->setUpdateAt($language->updated_at);
    }
}

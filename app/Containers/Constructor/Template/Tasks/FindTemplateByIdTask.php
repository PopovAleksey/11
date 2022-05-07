<?php

namespace App\Containers\Constructor\Template\Tasks;

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

class FindTemplateByIdTask extends Task implements FindTemplateByIdTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
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

            return (new TemplateDto())
                ->setId($template->id)
                ->setName($template->name)
                ->setType($template->type)
                ->setPageId($template->page_id)
                ->setChildPageId($template->child_page_id)
                ->setThemeId($template->theme_id)
                ->setLanguageId($template->language_id)
                ->setTheme($this->buildThemeDto($template->theme))
                ->setPage($this->buildPageDto($template->page))
                ->setChildPage($this->buildPageDto($template->child_page))
                ->setLanguage($this->buildLanguageDto($template->language))
                ->setCommonFilepath($template->common_filepath)
                ->setElementFilepath($template->element_filepath)
                ->setPreviewFilepath($template->preview_filepath)
                ->setCreateAt($template->created_at)
                ->setUpdateAt($template->updated_at);

        } catch (Exception) {
            throw new NotFoundException();
        }
    }

    /**
     * @param \App\Ship\Parents\Models\ThemeInterface $themeModel
     * @return \App\Ship\Parents\Dto\ThemeDto
     */
    private function buildThemeDto(ThemeInterface $themeModel): ThemeDto
    {
        return (new ThemeDto())
            ->setId($themeModel->id)
            ->setName($themeModel->name)
            ->setActive($themeModel->active)
            ->setCreateAt($themeModel->created_at)
            ->setUpdateAt($themeModel->updated_at);
    }

    /**
     * @param \App\Ship\Parents\Models\PageInterface|null $pageModel
     * @return \App\Ship\Parents\Dto\PageDto|null
     */
    private function buildPageDto(?PageInterface $pageModel): ?PageDto
    {
        if ($pageModel === null) {
            return null;
        }

        $fields = $pageModel->fields->map(function (PageFieldInterface $pageField) use ($pageModel) {
            return (new PageFieldDto())
                ->setId($pageField->id)
                ->setName($pageField->name)
                ->setActive($pageField->active)
                ->setType($pageField->type)
                ->setMask($pageField->mask)
                ->setPlaceholder($pageField->placeholder)
                ->setValues($pageField->values)
                ->setPageId($pageModel->id)
                ->setCreateAt($pageField->created_at)
                ->setUpdateAt($pageField->updated_at);
        })->toArray();

        $pageDto = (new PageDto())
            ->setId($pageModel->id)
            ->setName($pageModel->name)
            ->setActive($pageModel->active)
            ->setType($pageModel->type)
            ->setFields($fields)
            ->setCreateAt($pageModel->created_at)
            ->setUpdateAt($pageModel->updated_at);

        if (
            $pageModel->type === PageInterface::BLOG_TYPE &&
            $childPageDto = $this->buildPageDto($pageModel->child_page)
        ) {
            $pageDto->setChildPage($childPageDto);
        }

        return $pageDto;
    }

    /**
     * @param \App\Ship\Parents\Models\LanguageInterface|null $languageModel
     * @return \App\Ship\Parents\Dto\LanguageDto|null
     */
    private function buildLanguageDto(?LanguageInterface $languageModel): ?LanguageDto
    {
        if ($languageModel === null) {
            return null;
        }

        return (new LanguageDto())
            ->setId($languageModel->id)
            ->setName($languageModel->name)
            ->setShortName($languageModel->short_name)
            ->setIsActive($languageModel->active)
            ->setCreateAt($languageModel->created_at)
            ->setUpdateAt($languageModel->updated_at);
    }
}

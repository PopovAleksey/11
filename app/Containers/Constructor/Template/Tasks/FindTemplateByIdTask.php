<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Language\Models\LanguageInterface;
use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;
use App\Containers\Constructor\Page\Models\PageFieldInterface;
use App\Containers\Constructor\Page\Models\PageInterface;
use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Data\Repositories\TemplateRepositoryInterface;
use App\Containers\Constructor\Template\Models\ThemeInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindTemplateByIdTask extends Task implements FindTemplateByIdTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    /**
     * @param int $id
     * @return \App\Containers\Constructor\Template\Data\Dto\TemplateDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $id): TemplateDto
    {
        try {
            /**
             * @var \App\Containers\Constructor\Template\Models\TemplateInterface $template
             */
            $template = $this->repository->find($id);

            return (new TemplateDto())
                ->setId($template->id)
                ->setType($template->type)
                ->setTheme($this->buildThemeDto($template->theme))
                ->setPage($this->buildPageDto($template->page))
                ->setLanguage($this->buildLanguageDto($template->language))
                ->setCreateAt($template->created_at)
                ->setUpdateAt($template->updated_at);

        } catch (Exception) {
            throw new NotFoundException();
        }
    }

    /**
     * @param \App\Containers\Constructor\Template\Models\ThemeInterface $themeModel
     * @return \App\Containers\Constructor\Template\Data\Dto\ThemeDto
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
     * @param \App\Containers\Constructor\Page\Models\PageInterface|null $pageModel
     * @return \App\Containers\Constructor\Page\Data\Dto\PageDto|null
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
     * @param \App\Containers\Constructor\Language\Models\LanguageInterface|null $languageModel
     * @return \App\Containers\Constructor\Language\Data\Dto\LanguageDto|null
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

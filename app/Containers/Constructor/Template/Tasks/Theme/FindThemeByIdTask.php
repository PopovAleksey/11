<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindThemeByIdTask extends Task implements FindThemeByIdTaskInterface
{
    public function __construct(private ThemeRepositoryInterface $repository)
    {
    }

    /**
     * @param int $id
     * @return \App\Ship\Parents\Dto\ThemeDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $id): ThemeDto
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\ThemeInterface $theme
             */
            $theme = $this->repository->find($id);

            $templates = $theme->templates->collect()->map(static function (TemplateInterface $template) {
                $templateDto = (new TemplateDto())
                    ->setId($template->id)
                    ->setName($template->name)
                    ->setType($template->type)
                    ->setCreateAt($template->created_at)
                    ->setUpdateAt($template->updated_at);

                if (in_array($template->type, [TemplateInterface::PAGE_TYPE, TemplateInterface::WIDGET_TYPE], true)) {
                    $page = $template->page;

                    if ($page !== null) {
                        $pageDto = (new PageDto())
                            ->setId($page->id)
                            ->setType($page->type)
                            ->setName($page->name)
                            ->setActive($page->active)
                            ->setCreateAt($page->created_at)
                            ->setUpdateAt($page->updated_at);

                        $templateDto->setPage($pageDto);
                    }
                }

                if ($language = $template->language) {
                    $languageDto = (new LanguageDto())
                        ->setId($language->id)
                        ->setShortName($language->short_name)
                        ->setIsActive($language->active)
                        ->setName($language->name)
                        ->setCreateAt($language->created_at)
                        ->setUpdateAt($language->updated_at);

                    return $templateDto->setLanguage($languageDto);
                }

                return $templateDto;

            })->toArray();

            return (new ThemeDto())
                ->setId($theme->id)
                ->setName($theme->name)
                ->setActive($theme->active)
                ->setTemplates($templates)
                ->setCreateAt($theme->created_at)
                ->setUpdateAt($theme->updated_at);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}

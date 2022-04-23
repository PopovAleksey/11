<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Models\PageInterface;
use App\Containers\Constructor\Page\Tasks\GetAllPagesTaskInterface;
use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Models\TemplateInterface;
use App\Containers\Constructor\Template\Tasks\CreateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\CreateThemeTaskInterface;
use App\Ship\Parents\Actions\Action;

class CreateThemeAction extends Action implements CreateThemeActionInterface
{
    public function __construct(
        private CreateThemeTaskInterface    $createThemeTask,
        private CreateTemplateTaskInterface $createTemplateTask,
        private GetAllPagesTaskInterface    $getAllPagesTask
    )
    {
    }

    public function run(ThemeDto $data): int
    {
        $theme = $this->createThemeTask->run($data);

        collect([
            TemplateInterface::BASE_TYPE,
            TemplateInterface::JS_TYPE,
            TemplateInterface::CSS_TYPE,
            TemplateInterface::MENU_TYPE,
        ])->each(function (string $templateType) use ($theme) {
            $templateDto = (new TemplateDto())
                ->setType($templateType)
                ->setTheme($theme);

            $this->createTemplateTask->run($templateDto);
        });

        $this->getAllPagesTask->run()->each(function (PageDto $page) use ($theme) {
            $this->createPageTemplate($theme, $page);

            if (
                $page->getType() === PageInterface::BLOG_TYPE &&
                $childPage = $page->getChildPage()
            ) {
                $this->createPageTemplate($theme, $childPage);
            }
        });

        return $theme->getId();
    }

    private function createPageTemplate(ThemeDto $themeDto, PageDto $pageDto): void
    {
        $templateDto = (new TemplateDto())
            ->setType(TemplateInterface::PAGE_TYPE)
            ->setTheme($themeDto)
            ->setPage($pageDto);

        $this->createTemplateTask->run($templateDto);
    }
}


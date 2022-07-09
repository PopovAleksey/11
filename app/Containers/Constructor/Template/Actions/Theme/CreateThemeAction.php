<?php

namespace App\Containers\Constructor\Template\Actions\Theme;

use App\Containers\Constructor\Page\Tasks\Page\GetAllPagesTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\CreateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\Theme\CreateThemeTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use Illuminate\Support\Facades\DB;

class CreateThemeAction extends Action implements CreateThemeActionInterface
{
    public function __construct(
        private readonly CreateThemeTaskInterface    $createThemeTask,
        private readonly CreateTemplateTaskInterface $createTemplateTask,
        private readonly GetAllPagesTaskInterface    $getAllPagesTask
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $data
     * @return int
     * @throws \Throwable
     */
    public function run(ThemeDto $data): int
    {
        return DB::transaction(function () use ($data) {
            $themeDto = $this->createThemeTask->run($data);

            collect([
                TemplateInterface::BASE_TYPE,
                TemplateInterface::JS_TYPE,
                TemplateInterface::CSS_TYPE,
                TemplateInterface::MENU_TYPE,
            ])->each(function (string $templateType) use ($themeDto) {
                $templateDto = (new TemplateDto())
                    ->setType($templateType)
                    ->setTheme($themeDto);

                $this->createTemplateTask->run($templateDto);
            });

            $this->getAllPagesTask->run()->each(function (PageDto $pageDto) use ($themeDto) {
                $templateDto = (new TemplateDto())
                    ->setType(TemplateInterface::PAGE_TYPE)
                    ->setTheme($themeDto)
                    ->setChildPageId($pageDto->getChildPage()?->getId())
                    ->setPage($pageDto);

                $this->createTemplateTask->run($templateDto);
            });

            return $themeDto->getId();
        });
    }
}


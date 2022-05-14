<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class BuildPageTask extends Task implements BuildPageTaskInterface
{
    public function run(ThemeDto $themeDto, ContentDto $contentDto, Collection $menuList): string
    {
        /**
         * @var \App\Ship\Parents\Dto\TemplateDto $baseTemplate
         */
        $baseTemplate = $themeDto->getTemplates()->get(TemplateInterface::BASE_TYPE);
        $HTML         = $themeDto->getTemplates()
            ->get(TemplateInterface::MENU_TYPE);

        dd($themeDto, $contentDto, $menuList);
        return $baseTemplate->getCommonHtml();
    }

    private function buildMenu(ThemeDto $themeDto, Collection $menu): string
    {
        /**
         * @var \App\Ship\Parents\Dto\TemplateDto $menuTemplate
         */
        $menuTemplate    = $themeDto->getTemplates()->get(TemplateInterface::MENU_TYPE)?->first();
        $menuCommonHTML  = $menuTemplate->getCommonHtml();
        $menuElementHTML = $menuTemplate->getElementHtml();

        $items = $menu
            ->map(fn(Collection $menuItem) => str_replace(['{NAME}', '{LINK}'], [$menuItem->get('name'), $menuItem->get('link')], $menuElementHTML))
            ->implode("\n\r");

        return str_replace('{ITEMS}', $items, $menuCommonHTML);
    }
}

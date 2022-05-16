<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class BuildMenuTask extends Task implements BuildMenuTaskInterface
{
    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $themeDto
     * @param \Illuminate\Support\Collection $menusList
     * @param string                         $html
     * @return string
     */
    public function run(ThemeDto $themeDto, Collection $menusList, string $html): string
    {
        $menusList->each(function (Collection $menu) use ($themeDto, &$html) {
            /**
             * @var TemplateDto|null $template
             */
            $menuId   = $menu->first()?->get('template_id');
            $template = $themeDto->getTemplates()?->get(TemplateInterface::MENU_TYPE)?->get($menuId);

            if ($template === null) {
                return;
            }

            $menuItems = $menu->map(static function (Collection $item) use ($template) {
                return str_replace(
                    ['{NAME}', '{LINK}'],
                    [$item->get('name'), $item->get('link')],
                    $template->getElementHtml()
                );
            })->implode("\n");

            $menuHTML = str_replace('{ITEMS}', $menuItems, $template->getCommonHtml());
            $html     = str_replace("{MENU_{$menuId}}", $menuHTML, $html);
        });

        return $html;
    }
}

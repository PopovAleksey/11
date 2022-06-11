<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Dto\TemplateWidgetDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class BuildWidgetTask extends Task implements BuildWidgetTaskInterface
{
    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $themeDto
     * @param \Illuminate\Support\Collection $widgetList
     * @param string                         $html
     * @return string
     */
    public function run(ThemeDto $themeDto, Collection $widgetList, string $html): string
    {
        $widgetList->each(function (TemplateWidgetDto $widgetDto) use ($themeDto, &$html) {
            $templateId = $widgetDto->getTemplateId();
            $template   = $themeDto->getTemplates()?->get(TemplateInterface::WIDGET_TYPE)?->get($templateId);

            if ($template === null) {
                return;
            }

            $index = 1;
            $menuItems = $widgetDto->getContents()?->map(function (ContentDto $contentDto) use ($template, &$index) {
                $elementHtml = $template->getElementHtml();
                $this->replacePoints($contentDto->getValues(), $elementHtml);

                return str_replace(['{LINK}', '{INDEX}'], [$contentDto->getLink(), $index++], $elementHtml);
            })->implode("\n");

            $widgetHtml = str_replace('{ITEMS}', $menuItems, $template->getCommonHtml());
            $html       = str_replace("{WIDGET_$templateId}", $widgetHtml, $html);
        });

        return $html;
    }

    /**
     * @param \Illuminate\Support\Collection $values
     * @param string                         $html
     * @return void
     */
    private function replacePoints(Collection $values, string &$html): void
    {
        $values->each(static function (ContentValueDto $valueDto) use (&$html) {
            $html = str_replace("{FIELD_{$valueDto->getPageFieldId()}}", $valueDto->getValue(), $html);
        });
    }
}
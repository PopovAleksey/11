<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Tasks\Task;

class BuildPageTask extends Task implements BuildPageTaskInterface
{
    /**
     * @param \App\Ship\Parents\Dto\ThemeDto   $themeDto
     * @param \App\Ship\Parents\Dto\ContentDto $contentDto
     * @return string
     */
    public function run(ThemeDto $themeDto, ContentDto $contentDto): string
    {
        $html = $themeDto->getTemplates()?->get(TemplateInterface::PAGE_TYPE)?->getCommonHtml();

        $contentDto->getValues()->each(static function (ContentValueDto $valueDto) use (&$html) {
            $html = str_replace("{FIELD_{$valueDto->getPageFieldId()}}", $valueDto->getValue(), $html);
        });

        return $html;
    }
}

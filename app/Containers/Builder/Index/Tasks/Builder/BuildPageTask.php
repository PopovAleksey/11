<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class BuildPageTask extends Task implements BuildPageTaskInterface
{
    /**
     * @param \App\Ship\Parents\Dto\ThemeDto   $themeDto
     * @param \App\Ship\Parents\Dto\ContentDto $contentDto
     * @return string
     */
    public function run(ThemeDto $themeDto, ContentDto $contentDto): string
    {
        /**
         * @var \App\Ship\Parents\Dto\TemplateDto $templateDto
         */
        $templateDto     = $themeDto->getTemplates()?->get(TemplateInterface::PAGE_TYPE);
        $childContent    = $contentDto->getChildContent();
        $parentContentId = $contentDto->getParentContentId();
        $html            = ($parentContentId === null ? $templateDto?->getCommonHtml() : $templateDto?->getElementHtml()) ?? '';

        $this->replacePoints($contentDto->getValues(), $html);

        if ($childContent === null || $childContent->count() === 0) {
            return $html;
        }

        $previewHtml = $themeDto->getTemplates()?->get(TemplateInterface::PAGE_TYPE)?->getPreviewHtml();
        $previews    = $childContent->map(function (ContentDto $contentDto) use ($previewHtml) {
            $this->replacePoints($contentDto->getValues(), $previewHtml);

            return str_replace("{LINK}", $contentDto->getLink(), $previewHtml);
        });

        return str_replace('{PREVIEWS}', $previews->implode("\n\r"), $html);
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

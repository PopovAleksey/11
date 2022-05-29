<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Tasks\Task;

class BuildBaseJSandCSSTask extends Task implements BuildBaseJSandCSSTaskInterface
{
    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $themeDto
     * @return string
     */
    public function run(ThemeDto $themeDto): string
    {
        $html = $themeDto->getTemplates()?->get(TemplateInterface::BASE_TYPE)?->getCommonHtml();

        $themeDto->getTemplates()
            ?->get(TemplateInterface::JS_TYPE)
            ?->each(function (TemplateDto $templateDto) use ($themeDto, &$html) {
                $filePath = $this->getTemplateFile($templateDto, $themeDto);
                $html     = str_replace("{JAVASCRIPT_{$templateDto->getId()}}", $filePath, $html);
            });

        $themeDto->getTemplates()
            ?->get(TemplateInterface::CSS_TYPE)
            ?->map(function (TemplateDto $templateDto) use ($themeDto, &$html) {
                $filePath = $this->getTemplateFile($templateDto, $themeDto);
                $html     = str_replace("{CSS_{$templateDto->getId()}}", $filePath, $html);
            });

        return $html;
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateDto $template
     * @param \App\Ship\Parents\Dto\ThemeDto    $theme
     * @return string
     */
    private function getTemplateFile(TemplateDto $template, ThemeDto $theme): string
    {
        [$folder, $type] = match ($template->getType()) {
            TemplateInterface::CSS_TYPE => [
                config('constructor-template.folderName.css'),
                config('constructor-template.fileType.css'),
            ],
            TemplateInterface::JS_TYPE => [
                config('constructor-template.folderName.js'),
                config('constructor-template.fileType.js'),
            ],
            default => [
                config('constructor-template.folderName.view'),
                config('constructor-template.fileType.view'),
            ],
        };

        return asset(implode('/', [$theme->getDirectory(), $folder, $template->getCommonFilepath() . $type]));
    }
}

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
                [$commonFile] = $this->getTemplateFile($templateDto, $themeDto);
                $filePath = asset($commonFile);
                $html     = str_replace(
                    "{JAVASCRIPT_{$templateDto->getId()}}",
                    "<script src=\"{$filePath}\"></script>",
                    $html
                );
            });

        $themeDto->getTemplates()
            ?->get(TemplateInterface::CSS_TYPE)
            ?->map(function (TemplateDto $templateDto) use ($themeDto, &$html) {
                [$commonFile] = $this->getTemplateFile($templateDto, $themeDto);
                $filePath = asset($commonFile);
                $html     = str_replace(
                    "{CSS_{$templateDto->getId()}}",
                    "<link rel=\"stylesheet\" href=\"{$filePath}\">",
                    $html
                );
            });

        return $html;
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateDto $template
     * @param \App\Ship\Parents\Dto\ThemeDto    $theme
     * @return array
     */
    private function getTemplateFile(TemplateDto $template, ThemeDto $theme): array
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

        $commonFile  = implode('/', [$theme->getDirectory(), $folder, $template->getCommonFilepath() . $type]);
        $elementFile = implode('/', [$theme->getDirectory(), $folder, $template->getCommonFilepath() . $type]);
        $previewFile = implode('/', [$theme->getDirectory(), $folder, $template->getCommonFilepath() . $type]);

        return [$commonFile, $elementFile, $previewFile];
    }
}

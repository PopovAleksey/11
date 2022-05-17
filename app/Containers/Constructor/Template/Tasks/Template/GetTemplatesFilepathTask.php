<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Models\ThemeInterface;
use App\Ship\Parents\Tasks\Task;

class GetTemplatesFilepathTask extends Task implements GetTemplatesFilepathTaskInterface
{
    /**
     * @param \App\Ship\Parents\Models\TemplateInterface   $template
     * @param \App\Ship\Parents\Models\ThemeInterface|null $theme
     * @return array
     */
    public function run(TemplateInterface $template, ?ThemeInterface $theme = null): array
    {
        $theme = $theme ?? $template->theme;

        [$folder, $type] = match ($template->type) {
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

        $commonFile  = implode('/', [$theme->directory, $folder, $template->common_filepath . $type]);
        $elementFile = implode('/', [$theme->directory, $folder, $template->element_filepath . $type]);
        $previewFile = implode('/', [$theme->directory, $folder, $template->preview_filepath . $type]);

        return [$commonFile, $elementFile, $previewFile];
    }
}
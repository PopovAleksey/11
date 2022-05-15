<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class BuildPageTask extends Task implements BuildPageTaskInterface
{
    public function run(ThemeDto $themeDto, ContentDto $contentDto, Collection $menuList): string
    {
        $html    = $this->buildBaseJSandCSS($themeDto);
        $html    = $this->buildMenu($themeDto, $menuList, $html);
        $content = $this->buildSimplePage($themeDto, $contentDto);

        return str_replace('{CONTENT}', $content, $html);
    }

    private function buildBaseJSandCSS(ThemeDto $themeDto): string
    {
        $html = $themeDto->getTemplates()?->get(TemplateInterface::BASE_TYPE)?->getCommonHtml();

        $themeDto->getTemplates()?->get(TemplateInterface::JS_TYPE)
            ->each(function (TemplateDto $templateDto) use ($themeDto, &$html) {
                [$commonFile] = $this->getTemplateFile($templateDto, $themeDto);
                $filePath = asset($commonFile);
                $html     = str_replace(
                    "{JAVASCRIPT_{$templateDto->getId()}}",
                    "<script src=\"{$filePath}\"></script>",
                    $html
                );
            });

        $themeDto->getTemplates()?->get(TemplateInterface::CSS_TYPE)
            ->map(function (TemplateDto $templateDto) use ($themeDto, &$html) {
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

    private function buildMenu(ThemeDto $themeDto, Collection $menusList, string $html): string
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

    private function buildSimplePage(ThemeDto $themeDto, ContentDto $contentDto): string
    {
        $html = $themeDto->getTemplates()?->get(TemplateInterface::PAGE_TYPE)?->getCommonHtml();

        $contentDto->getValues()->each(static function (ContentValueDto $valueDto) use (&$html) {
            $html = str_replace("{FIELD_{$valueDto->getPageFieldId()}}", $valueDto->getValue(), $html);
        });

        return $html;
    }
}

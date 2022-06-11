<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class BuildTask extends Task implements BuildTaskInterface
{
    public function __construct(
        private BuildBaseJSandCSSTaskInterface $buildBaseJSandCSSTask,
        private BuildMenuTaskInterface         $buildMenuTask,
        private BuildPageTaskInterface         $buildPageTask,
        private BuildWidgetTaskInterface       $buildWidgetTask
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto   $themeDto
     * @param \App\Ship\Parents\Dto\ContentDto $contentDto
     * @param \Illuminate\Support\Collection   $menuList
     * @param \Illuminate\Support\Collection   $widgetList
     * @return string
     */
    public function run(ThemeDto $themeDto, ContentDto $contentDto, Collection $menuList, Collection $widgetList): string
    {
        $html = str_replace(
            '{CONTENT}',
            $this->buildPageTask->run($themeDto, $contentDto),
            $this->buildBaseJSandCSSTask->run($themeDto)
        );
        $html = $this->buildMenuTask->run($themeDto, $menuList, $html);

        return $this->buildWidgetTask->run($themeDto, $widgetList, $html);
    }
}

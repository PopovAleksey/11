<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class BuildTask extends Task implements BuildTaskInterface
{
    public function __construct(
        private readonly BuildBaseJSandCSSTaskInterface $buildBaseJSandCSSTask,
        private readonly BuildMenuTaskInterface         $buildMenuTask,
        private readonly BuildPageTaskInterface         $buildPageTask,
        private readonly BuildWidgetTaskInterface       $buildWidgetTask
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto   $themeDto
     * @param \App\Ship\Parents\Dto\ContentDto $contentDto
     * @param \Illuminate\Support\Collection   $menuList
     * @param \Illuminate\Support\Collection   $widgetList
     * @param \Illuminate\Support\Collection   $localeList
     * @return string
     */
    public function run(
        ThemeDto   $themeDto,
        ContentDto $contentDto,
        Collection $menuList,
        Collection $widgetList,
        Collection $localeList
    ): string
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

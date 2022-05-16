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
        private BuildPageTaskInterface         $buildPageTask
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto   $themeDto
     * @param \App\Ship\Parents\Dto\ContentDto $contentDto
     * @param \Illuminate\Support\Collection   $menuList
     * @return string
     */
    public function run(ThemeDto $themeDto, ContentDto $contentDto, Collection $menuList): string
    {
        $html    = $this->buildBaseJSandCSSTask->run($themeDto);
        $html    = $this->buildMenuTask->run($themeDto, $menuList, $html);
        $content = $this->buildPageTask->run($themeDto, $contentDto);

        return str_replace('{CONTENT}', $content, $html);
    }
}

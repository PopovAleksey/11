<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ThemeDto;
use Illuminate\Support\Collection;

interface BuildTaskInterface
{
    public function run(
        ThemeDto   $themeDto,
        ContentDto $contentDto,
        Collection $menuList,
        Collection $widgetList,
        Collection $localeList
    ): string;
}
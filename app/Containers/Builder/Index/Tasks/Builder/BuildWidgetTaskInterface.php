<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\ThemeDto;
use Illuminate\Support\Collection;

interface BuildWidgetTaskInterface
{
    public function run(ThemeDto $themeDto, Collection $widgetList, string $html): string;
}
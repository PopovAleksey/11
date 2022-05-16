<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\ThemeDto;
use Illuminate\Support\Collection;

interface BuildMenuTaskInterface
{
    public function run(ThemeDto $themeDto, Collection $menusList, string $html): string;
}
<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ThemeDto;
use Illuminate\Support\Collection;

interface BuildPageTaskInterface
{
    public function run(ThemeDto $themeDto, ContentDto $contentDto, Collection $menuList): string;
}
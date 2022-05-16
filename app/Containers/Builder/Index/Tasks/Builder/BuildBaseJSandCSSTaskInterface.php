<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\ThemeDto;

interface BuildBaseJSandCSSTaskInterface
{
    public function run(ThemeDto $themeDto): string;
}
<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;

use App\Ship\Parents\Dto\ThemeDto;

interface FindThemeByIdTaskInterface
{
    public function run(int $id): ThemeDto;
}
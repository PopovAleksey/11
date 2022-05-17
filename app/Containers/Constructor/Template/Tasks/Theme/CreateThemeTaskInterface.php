<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;

use App\Ship\Parents\Dto\ThemeDto;

interface CreateThemeTaskInterface
{
    public function run(ThemeDto $data): ThemeDto;
}
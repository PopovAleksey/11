<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;

use App\Ship\Parents\Dto\ThemeDto;

interface ActivateThemeTaskInterface
{
    public function run(ThemeDto $data): ThemeDto;
}
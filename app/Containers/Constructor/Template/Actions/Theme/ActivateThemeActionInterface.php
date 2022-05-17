<?php

namespace App\Containers\Constructor\Template\Actions\Theme;

use App\Ship\Parents\Dto\ThemeDto;

interface ActivateThemeActionInterface
{
    public function run(ThemeDto $data): ThemeDto;
}
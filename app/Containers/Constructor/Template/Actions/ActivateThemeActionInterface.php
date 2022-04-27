<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Ship\Parents\Dto\ThemeDto;

interface ActivateThemeActionInterface
{
    public function run(ThemeDto $data): ThemeDto;
}
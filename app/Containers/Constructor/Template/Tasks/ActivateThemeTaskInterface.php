<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Parents\Dto\ThemeDto;

interface ActivateThemeTaskInterface
{
    public function run(ThemeDto $data): ThemeDto;
}
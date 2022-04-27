<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Parents\Dto\ThemeDto;

interface CreateThemeTaskInterface
{
    public function run(ThemeDto $data): ThemeDto;
}
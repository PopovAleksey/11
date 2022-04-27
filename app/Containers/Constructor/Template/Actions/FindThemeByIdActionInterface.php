<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Ship\Parents\Dto\ThemeDto;

interface FindThemeByIdActionInterface
{
    public function run(int $id): ThemeDto;
}
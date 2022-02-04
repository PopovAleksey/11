<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;

interface UpdateThemeActionInterface
{
    public function run(ThemeDto $data): ThemeDto;
}
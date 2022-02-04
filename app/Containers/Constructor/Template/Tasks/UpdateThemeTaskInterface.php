<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;

interface UpdateThemeTaskInterface
{
    public function run(ThemeDto $data): ThemeDto;
}
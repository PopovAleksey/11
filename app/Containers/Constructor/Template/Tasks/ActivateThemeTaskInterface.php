<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;

interface ActivateThemeTaskInterface
{
    public function run(ThemeDto $data): ThemeDto;
}
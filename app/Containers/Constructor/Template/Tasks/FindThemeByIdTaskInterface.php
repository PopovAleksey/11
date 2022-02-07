<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;

interface FindThemeByIdTaskInterface
{
    public function run(int $id): ThemeDto;
}
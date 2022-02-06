<?php

namespace App\Containers\Constuctor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;

interface FindThemeByIdTaskInterface
{
    public function run(int $id): ThemeDto;
}
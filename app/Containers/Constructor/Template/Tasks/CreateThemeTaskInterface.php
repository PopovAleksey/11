<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;

interface CreateThemeTaskInterface
{
    public function run(ThemeDto $data);
}
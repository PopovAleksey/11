<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;

interface CreateThemeActionInterface
{
    public function run(ThemeDto $data): int;
}
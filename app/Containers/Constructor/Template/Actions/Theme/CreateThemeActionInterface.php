<?php

namespace App\Containers\Constructor\Template\Actions\Theme;

use App\Ship\Parents\Dto\ThemeDto;

interface CreateThemeActionInterface
{
    public function run(ThemeDto $data): int;
}
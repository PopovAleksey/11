<?php

namespace App\Containers\Constructor\Template\Actions\Theme;

use App\Ship\Parents\Dto\ThemeDto;

interface UpdateNameThemeActionInterface
{
    public function run(ThemeDto $data): void;
}
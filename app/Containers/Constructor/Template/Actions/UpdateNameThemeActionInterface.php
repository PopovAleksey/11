<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Ship\Parents\Dto\ThemeDto;

interface UpdateNameThemeActionInterface
{
    public function run(ThemeDto $data): bool;
}
<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;


use App\Ship\Parents\Dto\ThemeDto;

interface UpdateNameThemeTaskInterface
{
    public function run(ThemeDto $data): void;
}
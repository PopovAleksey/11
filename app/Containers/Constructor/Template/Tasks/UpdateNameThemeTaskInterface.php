<?php

namespace App\Containers\Constructor\Template\Tasks;


use App\Ship\Parents\Dto\ThemeDto;

interface UpdateNameThemeTaskInterface
{
    public function run(ThemeDto $data): bool;
}
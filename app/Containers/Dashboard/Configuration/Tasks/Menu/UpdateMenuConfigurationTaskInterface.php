<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use App\Ship\Parents\Dto\ConfigurationMenuDto;

interface UpdateMenuConfigurationTaskInterface
{
    public function run(ConfigurationMenuDto $menu): void;
}
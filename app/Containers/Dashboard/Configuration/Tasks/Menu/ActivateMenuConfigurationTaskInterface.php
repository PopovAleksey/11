<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use App\Ship\Parents\Dto\ConfigurationMenuDto;

interface ActivateMenuConfigurationTaskInterface
{
    public function run(ConfigurationMenuDto $data): bool;
}
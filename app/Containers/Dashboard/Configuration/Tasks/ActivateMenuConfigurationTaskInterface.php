<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Ship\Parents\Dto\ConfigurationMenuDto;

interface ActivateMenuConfigurationTaskInterface
{
    public function run(ConfigurationMenuDto $data): bool;
}
<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Ship\Parents\Dto\ConfigurationMenuDto;

interface CreateMenuConfigurationTaskInterface
{
    public function run(ConfigurationMenuDto $data): int;
}
<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Ship\Parents\Dto\ConfigurationCommonDto;

interface UpdateCommonConfigurationTaskInterface
{
    public function run(ConfigurationCommonDto $data): void;
}
<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Common;

use App\Ship\Parents\Dto\ConfigurationCommonDto;

interface UpdateCommonConfigurationTaskInterface
{
    public function run(ConfigurationCommonDto $configurationCommonDto): void;
}
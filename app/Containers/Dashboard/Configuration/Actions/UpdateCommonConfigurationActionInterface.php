<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Ship\Parents\Dto\ConfigurationCommonDto;

interface UpdateCommonConfigurationActionInterface
{
    public function run(ConfigurationCommonDto $data): void;
}
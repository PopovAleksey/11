<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Ship\Parents\Dto\ConfigurationMenuDto;

interface ActivateMenuConfigurationActionInterface
{
    public function run(ConfigurationMenuDto $data): bool;
}
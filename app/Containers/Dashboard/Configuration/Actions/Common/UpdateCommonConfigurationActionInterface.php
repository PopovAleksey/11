<?php

namespace App\Containers\Dashboard\Configuration\Actions\Common;

use App\Ship\Parents\Dto\ConfigurationCommonDto;

interface UpdateCommonConfigurationActionInterface
{
    public function run(ConfigurationCommonDto $data): void;
}
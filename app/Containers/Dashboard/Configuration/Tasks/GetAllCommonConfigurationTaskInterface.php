<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Ship\Parents\Dto\ConfigurationCommonDto;

interface GetAllCommonConfigurationTaskInterface
{
    public function run(): ConfigurationCommonDto;
}
<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Ship\Parents\Dto\ConfigurationCommonDto;

interface GetAllCommonConfigurationActionInterface
{
    public function run(): ConfigurationCommonDto;
}
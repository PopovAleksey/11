<?php

namespace App\Containers\Dashboard\Configuration\Actions\Common;

use App\Ship\Parents\Dto\ConfigurationCommonDto;

interface GetAllCommonConfigurationActionInterface
{
    public function run(): ConfigurationCommonDto;
}
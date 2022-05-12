<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Ship\Parents\Dto\ConfigurationMenuDto;

interface FindMenuConfigurationByIdActionInterface
{
    public function run(int $id): ConfigurationMenuDto;
}
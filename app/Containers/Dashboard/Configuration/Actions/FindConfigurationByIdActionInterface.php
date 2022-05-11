<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Ship\Parents\Dto\ConfigurationMenuDto;

interface FindConfigurationByIdActionInterface
{
    public function run(int $id): ConfigurationMenuDto;
}
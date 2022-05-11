<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Ship\Parents\Dto\ConfigurationMenuDto;

interface FindConfigurationByIdTaskInterface
{
    public function run(int $id): ConfigurationMenuDto;
}
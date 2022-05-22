<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use App\Ship\Parents\Dto\ConfigurationMenuDto;

interface CreateMenuConfigurationActionInterface
{
    public function run(ConfigurationMenuDto $data): int;
}
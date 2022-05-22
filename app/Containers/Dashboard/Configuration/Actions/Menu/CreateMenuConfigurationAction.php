<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use App\Containers\Dashboard\Configuration\Tasks\Menu\CreateMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationMenuDto;

class CreateMenuConfigurationAction extends Action implements CreateMenuConfigurationActionInterface
{
    public function __construct(
        private CreateMenuConfigurationTaskInterface $createConfigurationTask
    )
    {
    }

    public function run(ConfigurationMenuDto $data): int
    {
        return $this->createConfigurationTask->run($data);
    }
}


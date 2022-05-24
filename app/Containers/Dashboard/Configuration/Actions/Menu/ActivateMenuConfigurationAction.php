<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use App\Containers\Dashboard\Configuration\Tasks\Menu\ActivateMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationMenuDto;

class ActivateMenuConfigurationAction extends Action implements ActivateMenuConfigurationActionInterface
{
    public function __construct(
        private ActivateMenuConfigurationTaskInterface $activateMenuConfigurationTask
    )
    {
    }

    public function run(ConfigurationMenuDto $data): void
    {
        $this->activateMenuConfigurationTask->run($data);
    }
}

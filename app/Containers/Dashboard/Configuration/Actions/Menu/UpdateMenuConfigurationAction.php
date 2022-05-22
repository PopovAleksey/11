<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use App\Containers\Dashboard\Configuration\Tasks\Menu\UpdateMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationMenuDto;

class UpdateMenuConfigurationAction extends Action implements UpdateMenuConfigurationActionInterface
{
    public function __construct(
        private UpdateMenuConfigurationTaskInterface $updateConfigurationMenuTask
    )
    {
    }

    public function run(ConfigurationMenuDto $data): void
    {
        $this->updateConfigurationMenuTask->run($data);
    }
}

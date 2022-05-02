<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Containers\Dashboard\Configuration\Tasks\UpdateCommonConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationCommonDto;

class UpdateCommonConfigurationAction extends Action implements UpdateCommonConfigurationActionInterface
{
    public function __construct(
        private UpdateCommonConfigurationTaskInterface $updateConfigurationTask
    )
    {
    }

    public function run(ConfigurationCommonDto $data): void
    {
        $this->updateConfigurationTask->run($data);
    }
}

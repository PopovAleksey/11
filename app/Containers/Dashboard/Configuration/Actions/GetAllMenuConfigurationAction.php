<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Containers\Dashboard\Configuration\Tasks\GetAllConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllMenuConfigurationAction extends Action implements GetAllConfigurationsActionInterface
{
    public function __construct(
        private GetAllConfigurationTaskInterface $getAllConfigurationTask
    )
    {
    }

    public function run(): Collection
    {
        return $this->getAllConfigurationTask->run();
    }
}

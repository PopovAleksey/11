<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Containers\Dashboard\Configuration\Tasks\GetAllMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllMenuConfigurationAction extends Action implements GetAllMenuConfigurationActionInterface
{
    public function __construct(
        private GetAllMenuConfigurationTaskInterface $getAllConfigurationTask
    )
    {
    }

    public function run(): Collection
    {
        return $this->getAllConfigurationTask->run();
    }
}

<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Containers\Dashboard\Configuration\Tasks\UpdateMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class UpdateMenuConfigurationAction extends Action implements UpdateMenuConfigurationActionInterface
{
    public function __construct(
        private UpdateMenuConfigurationTaskInterface $updateConfigurationMenuTask
    )
    {
    }

    public function run(Collection $data): bool
    {
        return $this->updateConfigurationMenuTask->run($data);
    }
}

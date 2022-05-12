<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Containers\Dashboard\Configuration\Tasks\DeleteMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteMenuConfigurationAction extends Action implements DeleteMenuConfigurationActionInterface
{
    public function __construct(
        private DeleteMenuConfigurationTaskInterface $deleteConfigurationTask
    )
    {
    }

    public function run(int $id): bool
    {
        return $this->deleteConfigurationTask->run($id);
    }
}


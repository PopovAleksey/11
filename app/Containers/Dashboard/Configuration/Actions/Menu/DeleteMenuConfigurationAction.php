<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use App\Containers\Dashboard\Configuration\Tasks\Menu\DeleteMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteMenuConfigurationAction extends Action implements DeleteMenuConfigurationActionInterface
{
    public function __construct(
        private DeleteMenuConfigurationTaskInterface $deleteConfigurationTask
    )
    {
    }

    public function run(int $id): void
    {
        $this->deleteConfigurationTask->run($id);
    }
}


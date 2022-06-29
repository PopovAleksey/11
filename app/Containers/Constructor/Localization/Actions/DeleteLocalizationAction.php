<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Containers\Constructor\Localization\Tasks\DeleteLocalizationTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteLocalizationAction extends Action implements DeleteLocalizationActionInterface
{
    public function __construct(
        private DeleteLocalizationTaskInterface $deleteLocalizationTask
    )
    {
    }

    public function run(int $id): void
    {
        $this->deleteLocalizationTask->run($id);
    }
}


<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Tasks\DeleteThemeTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteThemeAction extends Action implements DeleteThemeActionInterface
{
    public function __construct(
        private DeleteThemeTaskInterface $deleteThemeTask
    )
    {
    }

    public function run(int $id): bool
    {
        return $this->deleteThemeTask->run($id);
    }
}


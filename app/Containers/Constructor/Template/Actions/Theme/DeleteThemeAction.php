<?php

namespace App\Containers\Constructor\Template\Actions\Theme;

use App\Containers\Constructor\Template\Tasks\Theme\DeleteThemeTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteThemeAction extends Action implements DeleteThemeActionInterface
{
    public function __construct(
        private DeleteThemeTaskInterface $deleteThemeTask
    )
    {
    }

    public function run(int $id): void
    {
        $this->deleteThemeTask->run($id);
    }
}


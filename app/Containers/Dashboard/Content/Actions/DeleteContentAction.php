<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Tasks\DeleteContentTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteContentAction extends Action implements DeleteContentActionInterface
{
    public function __construct(
        private DeleteContentTaskInterface $deleteContentTask
    )
    {
    }

    public function run(int $id): bool
    {
        return $this->deleteContentTask->run($id);
    }
}


<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Tasks\DeletePageTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeletePageAction extends Action implements DeletePageActionInterface
{
    public function __construct(
        private DeletePageTaskInterface $deletePageTask
    )
    {
    }

    public function run(int $id): bool
    {
        return $this->deletePageTask->run($id);
    }
}


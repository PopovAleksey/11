<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Tasks\Page\DeletePageTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeletePageAction extends Action implements DeletePageActionInterface
{
    public function __construct(
        private DeletePageTaskInterface $deletePageTask
    )
    {
    }

    public function run(int $id): void
    {
        $this->deletePageTask->run($id);
    }
}


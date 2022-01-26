<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Tasks\DeleteLanguageTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteLanguageAction extends Action implements DeleteLanguageActionInterface
{
    public function __construct(private DeleteLanguageTaskInterface $deleteLanguageTask)
    {
    }

    public function run(int $id): bool
    {
        $this->deleteLanguageTask->run($id);

        return true;
    }
}

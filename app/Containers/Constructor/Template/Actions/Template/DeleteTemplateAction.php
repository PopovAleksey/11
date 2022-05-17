<?php

namespace App\Containers\Constructor\Template\Actions\Template;

use App\Containers\Constructor\Template\Tasks\Template\DeleteTemplateTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteTemplateAction extends Action implements DeleteTemplateActionInterface
{
    public function __construct(
        private DeleteTemplateTaskInterface $deleteTemplateTask
    )
    {
    }

    public function run(int $id): void
    {
        $this->deleteTemplateTask->run($id);
    }
}


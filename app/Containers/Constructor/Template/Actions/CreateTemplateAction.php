<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Tasks\CreateTemplateTaskInterface;
use App\Ship\Parents\Actions\Action;

class CreateTemplateAction extends Action implements CreateTemplateActionInterface
{
    public function __construct(
        private CreateTemplateTaskInterface $createTemplateTask
    )
    {
    }

    public function run(TemplateDto $data): int
    {
        return $this->createTemplateTask->run($data);
    }
}


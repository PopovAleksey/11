<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Tasks\UpdateTemplateTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;

class UpdateTemplateAction extends Action implements UpdateTemplateActionInterface
{
    public function __construct(
        private UpdateTemplateTaskInterface $updateTemplateTask
    )
    {
    }

    public function run(TemplateDto $data): TemplateDto
    {
        return $this->updateTemplateTask->run($data);
    }
}

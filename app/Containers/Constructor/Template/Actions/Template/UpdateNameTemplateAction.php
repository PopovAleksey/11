<?php

namespace App\Containers\Constructor\Template\Actions\Template;


use App\Containers\Constructor\Template\Tasks\Template\UpdateTemplateTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;

class UpdateNameTemplateAction extends Action implements UpdateNameTemplateActionInterface
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

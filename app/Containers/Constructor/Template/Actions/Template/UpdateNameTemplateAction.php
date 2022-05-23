<?php

namespace App\Containers\Constructor\Template\Actions\Template;


use App\Containers\Constructor\Template\Tasks\Template\UpdateNameTemplateTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;

class UpdateNameTemplateAction extends Action implements UpdateNameTemplateActionInterface
{
    public function __construct(
        private UpdateNameTemplateTaskInterface $updateTemplateTask
    )
    {
    }

    public function run(TemplateDto $data): void
    {
        $this->updateTemplateTask->run($data);
    }
}

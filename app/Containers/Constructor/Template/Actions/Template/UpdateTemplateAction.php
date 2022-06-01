<?php

namespace App\Containers\Constructor\Template\Actions\Template;

use App\Containers\Constructor\Template\Tasks\Template\UpdateNameTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\UpdateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\UpdateTemplateWidgetTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;

class UpdateTemplateAction extends Action implements UpdateTemplateActionInterface
{
    public function __construct(
        private UpdateTemplateTaskInterface       $updateTemplateTask,
        private UpdateNameTemplateTaskInterface   $updateNameTemplateTask,
        private UpdateTemplateWidgetTaskInterface $updateTemplateWidgetTask
    )
    {
    }

    public function run(TemplateDto $data): TemplateDto
    {
        $templateDto = $this->updateTemplateTask->run($data);
        $this->updateNameTemplateTask->run($data);

        if ($data->getWidget() !== null) {
            $this->updateTemplateWidgetTask->run($data->getWidget());
        }

        return $templateDto;
    }
}

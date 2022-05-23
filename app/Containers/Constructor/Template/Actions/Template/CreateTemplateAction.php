<?php

namespace App\Containers\Constructor\Template\Actions\Template;

use App\Containers\Constructor\Page\Tasks\Page\FindPageByIdTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\CreateTemplateTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Models\TemplateInterface;

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


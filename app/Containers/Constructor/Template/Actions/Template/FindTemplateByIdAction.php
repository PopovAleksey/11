<?php

namespace App\Containers\Constructor\Template\Actions\Template;

use App\Containers\Constructor\Template\Tasks\Template\FindTemplateByIdTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;

class FindTemplateByIdAction extends Action implements FindTemplateByIdActionInterface
{
    public function __construct(
        private FindTemplateByIdTaskInterface $findTemplateByIdTask
    )
    {
    }

    public function run(int $id): TemplateDto
    {
        return $this->findTemplateByIdTask->run($id);
    }
}

<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Tasks\FindTemplateByIdTaskInterface;
use App\Ship\Parents\Actions\Action;

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

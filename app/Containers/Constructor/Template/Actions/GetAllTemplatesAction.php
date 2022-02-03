<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Tasks\GetAllTemplatesTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllTemplatesAction extends Action implements GetAllTemplatesActionInterface
{
    public function __construct(
        private GetAllTemplatesTaskInterface $getAllTemplateTask
    )
    {
    }

    public function run(): Collection
    {
        return $this->getAllTemplateTask->run();
    }
}

<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationMenuDto;

class FindConfigurationByIdAction extends Action implements FindConfigurationByIdActionInterface
{
    public function __construct(
        private FindConfigurationByIdTaskInterface $findConfigurationByIdTask
    )
    {
    }

    public function run(int $id): ConfigurationMenuDto
    {
        return $this->findConfigurationByIdTask->run($id);
    }
}

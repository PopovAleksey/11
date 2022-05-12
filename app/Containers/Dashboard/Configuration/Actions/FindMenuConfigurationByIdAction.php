<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Containers\Dashboard\Configuration\Tasks\FindMenuConfigurationByIdTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationMenuDto;

class FindMenuConfigurationByIdAction extends Action implements FindMenuConfigurationByIdActionInterface
{
    public function __construct(
        private FindMenuConfigurationByIdTaskInterface $findConfigurationByIdTask
    )
    {
    }

    public function run(int $id): ConfigurationMenuDto
    {
        return $this->findConfigurationByIdTask->run($id);
    }
}

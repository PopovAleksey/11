<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class ActivateMenuConfigurationTask extends Task implements ActivateMenuConfigurationTaskInterface
{
    public function __construct(
        private readonly ConfigurationMenuRepositoryInterface $repository
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ConfigurationMenuDto $data
     * @return void
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(ConfigurationMenuDto $data): void
    {
        try {
            $this->repository->update(['active' => $data->getActive()], $data->getId());

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}

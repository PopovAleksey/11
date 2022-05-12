<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class ActivateMenuConfigurationTask extends Task implements ActivateMenuConfigurationTaskInterface
{
    public function __construct(private ConfigurationMenuRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ConfigurationMenuDto $data
     * @return bool
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(ConfigurationMenuDto $data): bool
    {
        try {
            $this->repository->update(['active' => $data->getActive()], $data->getId());

            return true;

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}

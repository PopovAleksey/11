<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteMenuConfigurationTask extends Task implements DeleteMenuConfigurationTaskInterface
{
    public function __construct(private ConfigurationMenuRepositoryInterface $repository)
    {
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \App\Ship\Exceptions\DeleteResourceFailedException
     */
    public function run(int $id): ?bool
    {
        try {
            return $this->repository->delete($id);
        } catch (Exception) {
            throw new DeleteResourceFailedException();
        }
    }
}

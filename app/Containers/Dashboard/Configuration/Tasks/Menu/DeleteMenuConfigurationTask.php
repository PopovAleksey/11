<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteMenuConfigurationTask extends Task implements DeleteMenuConfigurationTaskInterface
{
    public function __construct(
        private readonly ConfigurationMenuRepositoryInterface $repository
    )
    {
    }

    /**
     * @param int $id
     * @return void
     * @throws \App\Ship\Exceptions\DeleteResourceFailedException
     */
    public function run(int $id): void
    {
        try {
            $this->repository->delete($id);

        } catch (Exception) {
            throw new DeleteResourceFailedException();
        }
    }
}

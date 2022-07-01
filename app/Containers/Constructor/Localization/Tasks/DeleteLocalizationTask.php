<?php

namespace App\Containers\Constructor\Localization\Tasks;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Repositories\LocalizationRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteLocalizationTask extends Task implements DeleteLocalizationTaskInterface
{
    public function __construct(private readonly LocalizationRepositoryInterface $repository)
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

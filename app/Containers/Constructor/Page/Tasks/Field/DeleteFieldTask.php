<?php

namespace App\Containers\Constructor\Page\Tasks\Field;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Repositories\PageFieldRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteFieldTask extends Task implements DeleteFieldTaskInterface
{
    public function __construct(private PageFieldRepositoryInterface $repository)
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

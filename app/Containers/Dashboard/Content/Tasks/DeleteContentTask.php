<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteContentTask extends Task implements DeleteContentTaskInterface
{
    public function __construct(private ContentRepositoryInterface $repository)
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

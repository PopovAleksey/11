<?php

namespace App\Containers\Constructor\Language\Tasks;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteLanguageTask extends Task implements DeleteLanguageTaskInterface
{
    public function __construct(
        private readonly LanguageRepositoryInterface $repository
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

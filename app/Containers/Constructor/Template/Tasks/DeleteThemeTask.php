<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteThemeTask extends Task implements DeleteThemeTaskInterface
{
    public function __construct(private ThemeRepositoryInterface $repository)
    {
    }

    /**
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

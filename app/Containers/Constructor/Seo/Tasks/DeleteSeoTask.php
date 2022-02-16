<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Containers\Constructor\Seo\Data\Repositories\SeoRepositoryInterface;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteSeoTask extends Task implements DeleteSeoTaskInterface
{
    public function __construct(private SeoRepositoryInterface $repository)
    {
    }

    public function run(int $id): ?bool
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}

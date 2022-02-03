<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Repositories\TemplateRepositoryInterface;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteTemplateTask extends Task implements DeleteTemplateTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
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

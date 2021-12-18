<?php

namespace App\Containers\CoreSection\Authentication\Tasks;

use App\Containers\CoreSection\Authentication\Data\Repositories\AuthenticationRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteAuthenticationTask extends Task
{
    protected AuthenticationRepository $repository;

    public function __construct(AuthenticationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id): ?int
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}

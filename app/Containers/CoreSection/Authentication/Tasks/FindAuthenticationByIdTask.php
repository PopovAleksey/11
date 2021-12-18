<?php

namespace App\Containers\CoreSection\Authentication\Tasks;

use App\Containers\CoreSection\Authentication\Data\Repositories\AuthenticationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindAuthenticationByIdTask extends Task
{
    protected AuthenticationRepository $repository;

    public function __construct(AuthenticationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}

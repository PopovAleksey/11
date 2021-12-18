<?php

namespace App\Containers\CoreSection\Authentication\Tasks;

use App\Containers\CoreSection\Authentication\Data\Repositories\AuthenticationRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllAuthenticationsTask extends Task
{
    protected AuthenticationRepository $repository;

    public function __construct(AuthenticationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}

<?php

namespace App\Containers\Core\User\Tasks;

use App\Containers\Core\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task;

class CountUsersTask extends Task
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(): int
    {
        return $this->repository->all()->count();
    }
}

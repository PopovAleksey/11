<?php

namespace App\Containers\CoreSection\Authentication\Tasks;

use App\Containers\CoreSection\Authentication\Data\Repositories\AuthenticationRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateAuthenticationTask extends Task
{
    protected AuthenticationRepository $repository;

    public function __construct(AuthenticationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}

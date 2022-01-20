<?php

namespace App\Containers\Core\User\Tasks;

use App\Containers\Core\User\Data\Repositories\UserRepository;
use App\Containers\Core\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateUserByCredentialsTask extends Task implements CreateUserByCredentialsTaskInterface
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param bool        $isAdmin
     * @param string      $email
     * @param string      $password
     * @param string|NULL $name
     * @param string|NULL $gender
     * @param string|NULL $birth
     * @return \App\Containers\Core\User\Models\User
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(
        bool   $isAdmin,
        string $email,
        string $password,
        string $name = null,
        string $gender = null,
        string $birth = null
    ): User
    {
        try {
            // create new user
            $user = $this->repository->create([
                'password' => Hash::make($password),
                'email'    => $email,
                'name'     => $name,
                'gender'   => $gender,
                'birth'    => $birth,
                'is_admin' => $isAdmin,
            ]);

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }

        return $user;
    }
}

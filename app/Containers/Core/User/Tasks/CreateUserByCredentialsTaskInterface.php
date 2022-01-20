<?php

namespace App\Containers\Core\User\Tasks;

use App\Containers\Core\User\Models\User;

interface CreateUserByCredentialsTaskInterface
{
    public function run(
        bool   $isAdmin,
        string $email,
        string $password,
        string $name = NULL,
        string $gender = NULL,
        string $birth = NULL
    ): User;
}

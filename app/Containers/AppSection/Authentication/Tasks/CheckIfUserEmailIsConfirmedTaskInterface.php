<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Containers\AppSection\User\Data\Dto\UserDto;

interface CheckIfUserEmailIsConfirmedTaskInterface
{
    public function run(UserDto $user): bool;
}

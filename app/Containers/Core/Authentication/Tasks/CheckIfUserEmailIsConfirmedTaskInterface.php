<?php

namespace App\Containers\Core\Authentication\Tasks;

use App\Containers\Core\User\Data\Dto\UserDto;

interface CheckIfUserEmailIsConfirmedTaskInterface
{
    public function run(UserDto $user): bool;
}

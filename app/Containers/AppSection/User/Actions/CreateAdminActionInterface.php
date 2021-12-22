<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Data\Dto\UserDto;

interface CreateAdminActionInterface
{
    public function run(UserDto $userDto): UserDto;
}

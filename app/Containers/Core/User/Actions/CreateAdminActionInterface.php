<?php

namespace App\Containers\Core\User\Actions;

use App\Containers\Core\User\Data\Dto\UserDto;

interface CreateAdminActionInterface
{
    public function run(UserDto $userDto): UserDto;
}

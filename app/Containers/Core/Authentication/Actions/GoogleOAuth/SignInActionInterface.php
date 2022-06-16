<?php

namespace App\Containers\Core\Authentication\Actions\GoogleOAuth;

use App\Containers\Core\User\Data\Dto\UserDto;

interface SignInActionInterface
{
    public function run(string $code): UserDto;
}
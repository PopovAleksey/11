<?php

namespace App\Containers\AppSection\User;

use App\Containers\AppSection\User\Data\Dto\UserDto;
use Illuminate\Validation\UnauthorizedException;

class Auth extends \Illuminate\Support\Facades\Auth
{
    public static function user(): UserDto
    {
        if (!parent::check()) {
            throw new UnauthorizedException();
        }

        $user = parent::user();

        return (new UserDto())
            ->setId($user?->id)
            ->setName($user?->name)
            ->setEmail($user?->email)
            ->setPassword($user?->password)
            ->setEmailVerifiedAt($user?->email_verified_at)
            ->setGender($user?->gender)
            ->setBirth($user?->birth)
            ->setDevice($user?->device)
            ->setPlatform($user?->platform)
            ->setIsAdmin($user?->is_admin)
            ->setRememberToken($user?->remember_token)
            ->setCreatedAt($user?->created_at)
            ->setUpdatedAt($user?->updated_at);
    }

}
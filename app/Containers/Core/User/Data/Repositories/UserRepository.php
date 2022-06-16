<?php

namespace App\Containers\Core\User\Data\Repositories;

use App\Containers\Core\User\Models\UserInterface;
use App\Ship\Parents\Repositories\Repository;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected $fieldSearchable = [
        'name'              => 'like',
        'id'                => '=',
        'email'             => '=',
        'email_verified_at' => '=',
        'created_at'        => 'like',
    ];

    public function model(): string
    {
        return UserInterface::class;
    }
}

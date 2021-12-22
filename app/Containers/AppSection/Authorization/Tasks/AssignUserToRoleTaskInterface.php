<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;

interface AssignUserToRoleTaskInterface
{
    public function run(User $user, array $roles): Authenticatable;
}

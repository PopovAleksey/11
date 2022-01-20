<?php

namespace App\Containers\Core\Authorization\Tasks;

use App\Containers\Core\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;

class AssignUserToRoleTask extends Task implements AssignUserToRoleTaskInterface
{
    public function run(User $user, array $roles): Authenticatable
    {
        return $user->assignRole($roles);
    }
}

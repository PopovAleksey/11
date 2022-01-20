<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Tasks\FindRoleTask;
use App\Containers\Core\Authorization\UI\API\Requests\RevokeUserFromRoleRequest;
use App\Containers\Core\User\Models\User;
use App\Containers\Core\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;
use Illuminate\Database\Eloquent\Collection;

class RevokeUserFromRoleAction extends Action
{
    public function run(RevokeUserFromRoleRequest $request): User
    {
        $user = null;

        // if user ID is passed then convert it to instance of User (could be user Id Or Model)
        if (!$request->user_id instanceof User) {
            $user = app(FindUserByIdTask::class)->run($request->user_id);
        }

        // convert to array in case single ID was passed (could be Single Or Multiple Role Ids)
        $rolesIds = (array)$request->roles_ids;

        $roles = new Collection();

        foreach ($rolesIds as $roleId) {
            $role = app(FindRoleTask::class)->run($roleId);
            $roles->add($role);
        }

        foreach ($roles->pluck('name')->toArray() as $roleName) {
            $user->removeRole($roleName);
        }

        return $user;
    }
}

<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Tasks\FindRoleTask;
use App\Containers\Core\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\Core\User\Models\User;
use App\Containers\Core\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;

class SyncUserRolesAction extends Action
{
    public function run(SyncUserRolesRequest $request): User
    {
        $user = app(FindUserByIdTask::class)->run($request->user_id);

        // convert roles IDs to array (in case single id passed)
        $rolesIds = (array)$request->roles_ids;

        $roles = array_map(static function ($roleId) {
            return app(FindRoleTask::class)->run($roleId);
        }, $rolesIds);

        $user->syncRoles($roles);

        return $user;
    }
}

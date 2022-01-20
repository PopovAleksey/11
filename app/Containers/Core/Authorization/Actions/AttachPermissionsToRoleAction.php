<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Models\Role;
use App\Containers\Core\Authorization\Tasks\FindPermissionTask;
use App\Containers\Core\Authorization\Tasks\FindRoleTask;
use App\Containers\Core\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;
use App\Ship\Parents\Actions\Action;

class AttachPermissionsToRoleAction extends Action
{
    public function run(AttachPermissionToRoleRequest $request): Role
    {
        $role = app(FindRoleTask::class)->run($request->role_id);

        // convert to array in case single ID was passed
        $permissionIds = (array)$request->permissions_ids;

        $permissions = array_map(static function ($permissionId) {
            return app(FindPermissionTask::class)->run($permissionId);
        }, $permissionIds);

        return $role->givePermissionTo($permissions);
    }
}

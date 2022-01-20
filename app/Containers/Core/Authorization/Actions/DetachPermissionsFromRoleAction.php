<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Models\Role;
use App\Containers\Core\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Containers\Core\Authorization\Tasks\FindRoleTask;
use App\Containers\Core\Authorization\UI\API\Requests\DetachPermissionToRoleRequest;
use App\Ship\Parents\Actions\Action;

class DetachPermissionsFromRoleAction extends Action
{
    public function run(DetachPermissionToRoleRequest $request): Role
    {
        $role = app(FindRoleTask::class)->run($request->role_id);
        return app(DetachPermissionsFromRoleTask::class)->run($role, $request->permissions_ids);
    }
}

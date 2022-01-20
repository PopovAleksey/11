<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Core\Authorization\Models\Role;
use App\Containers\Core\Authorization\Tasks\FindRoleTask;
use App\Containers\Core\Authorization\UI\API\Requests\FindRoleRequest;
use App\Ship\Parents\Actions\Action;

class FindRoleAction extends Action
{
    public function run(FindRoleRequest $request): Role
    {
        $role = app(FindRoleTask::class)->run($request->id);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }
}

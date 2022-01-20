<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\Core\Authorization\Tasks\FindRoleTask;
use App\Containers\Core\Authorization\UI\API\Requests\AssignUserToRoleRequest;
use App\Containers\Core\User\Models\User;
use App\Containers\Core\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;

class AssignUserToRoleAction extends Action
{
    public function run(AssignUserToRoleRequest $request): User
    {
        $user = app(FindUserByIdTask::class)->run($request->user_id);

        // convert to array in case single ID was passed
        $rolesIds = (array)$request->roles_ids;

        $roles = array_map(static function ($roleId) {
            return app(FindRoleTask::class)->run($roleId);
        }, $rolesIds);

        return app(AssignUserToRoleTask::class)->run($user, $roles);
    }
}

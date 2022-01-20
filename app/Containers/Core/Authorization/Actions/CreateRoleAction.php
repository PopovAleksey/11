<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Models\Role;
use App\Containers\Core\Authorization\Tasks\CreateRoleTask;
use App\Containers\Core\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Ship\Parents\Actions\Action;

class CreateRoleAction extends Action
{
    public function run(CreateRoleRequest $request): Role
    {
        $level = is_null($request->level) ? 0 : $request->level;

        return app(CreateRoleTask::class)->run($request->name, $request->description, $request->display_name, $level);
    }
}

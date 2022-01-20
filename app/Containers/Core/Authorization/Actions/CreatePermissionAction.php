<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Models\Permission;
use App\Containers\Core\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreatePermissionAction extends Action
{
    public function run(Request $request): Permission
    {
        return app(CreatePermissionTask::class)->run($request->name, $request->description, $request->display_name);
    }
}

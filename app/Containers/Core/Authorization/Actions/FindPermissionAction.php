<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\Core\Authorization\Models\Permission;
use App\Containers\Core\Authorization\Tasks\FindPermissionTask;
use App\Containers\Core\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\App;

class FindPermissionAction extends Action
{
    public function run(FindPermissionRequest $request): Permission
    {
        $permission = App::make(FindPermissionTask::class)->run($request->id);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }
}

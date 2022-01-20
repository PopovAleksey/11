<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Parents\Actions\Action;

class GetAllPermissionsAction extends Action
{
    public function run()
    {
        return app(GetAllPermissionsTask::class)->run();
    }
}

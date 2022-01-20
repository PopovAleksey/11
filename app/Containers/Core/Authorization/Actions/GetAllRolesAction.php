<?php

namespace App\Containers\Core\Authorization\Actions;

use App\Containers\Core\Authorization\Tasks\GetAllRolesTask;
use App\Ship\Parents\Actions\Action;

class GetAllRolesAction extends Action
{
    public function run()
    {
        return app(GetAllRolesTask::class)->run();
    }
}

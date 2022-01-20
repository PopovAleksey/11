<?php

namespace App\Containers\Core\User\Actions;

use App\Containers\Core\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;

class GetAllAdminsAction extends Action
{
    public function run()
    {
        return app(GetAllUsersTask::class)->addRequestCriteria()->admins()->ordered()->run();
    }
}

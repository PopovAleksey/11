<?php

namespace App\Containers\Core\User\Actions;

use App\Containers\Core\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;

class GetAllUsersAction extends Action
{
    public function run()
    {
        return app(GetAllUsersTask::class)->addRequestCriteria()->ordered()->run();
    }
}

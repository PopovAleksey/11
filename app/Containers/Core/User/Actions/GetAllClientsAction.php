<?php

namespace App\Containers\Core\User\Actions;

use App\Containers\Core\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;

class GetAllClientsAction extends Action
{
    public function run()
    {
        return app(GetAllUsersTask::class)->addRequestCriteria()->clients()->ordered()->run();
    }
}

<?php

namespace App\Containers\CoreSection\User\Actions;

use App\Containers\CoreSection\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllUsersAction extends Action
{
    public function run(Request $request)
    {
        return app(GetAllUsersTask::class)->addRequestCriteria()->run();
    }
}

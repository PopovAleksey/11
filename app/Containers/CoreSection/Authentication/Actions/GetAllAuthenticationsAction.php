<?php

namespace App\Containers\CoreSection\Authentication\Actions;

use App\Containers\CoreSection\Authentication\Tasks\GetAllAuthenticationsTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllAuthenticationsAction extends Action
{
    public function run(Request $request)
    {
        return app(GetAllAuthenticationsTask::class)->addRequestCriteria()->run();
    }
}

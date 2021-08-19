<?php

namespace App\Containers\CoreSection\User\Actions;

use App\Containers\CoreSection\User\Models\User;
use App\Containers\CoreSection\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindUserByIdAction extends Action
{
    public function run(Request $request): User
    {
        return app(FindUserByIdTask::class)->run($request->id);
    }
}

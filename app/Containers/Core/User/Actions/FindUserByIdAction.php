<?php

namespace App\Containers\Core\User\Actions;

use App\Containers\Core\User\Models\User;
use App\Containers\Core\User\Tasks\FindUserByIdTask;
use App\Containers\Core\User\UI\API\Requests\FindUserByIdRequest;
use App\Ship\Parents\Actions\Action;

class FindUserByIdAction extends Action
{
    public function run(FindUserByIdRequest $request): User
    {
        return app(FindUserByIdTask::class)->run($request->id);
    }
}

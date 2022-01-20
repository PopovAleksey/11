<?php

namespace App\Containers\Core\User\Actions;

use App\Containers\Core\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Core\User\Tasks\DeleteUserTask;
use App\Containers\Core\User\Tasks\FindUserByIdTask;
use App\Containers\Core\User\UI\API\Requests\DeleteUserRequest;
use App\Ship\Parents\Actions\Action;

class DeleteUserAction extends Action
{
    public function run(DeleteUserRequest $request): void
    {
        $user = $request->id
            ? app(FindUserByIdTask::class)->run($request->id)
            : app(GetAuthenticatedUserTask::class)->run();

        app(DeleteUserTask::class)->run($user);
    }
}

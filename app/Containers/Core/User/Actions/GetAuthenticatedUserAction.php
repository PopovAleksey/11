<?php

namespace App\Containers\Core\User\Actions;

use App\Containers\Core\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Core\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;

class GetAuthenticatedUserAction extends Action
{
    public function run(): User
    {
        $user = app(GetAuthenticatedUserTask::class)->run();

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }
}

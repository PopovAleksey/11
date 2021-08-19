<?php

namespace App\Containers\CoreSection\User\Actions;

use App\Containers\CoreSection\User\Models\User;
use App\Containers\CoreSection\User\Tasks\CreateUserTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateUserAction extends Action
{
    public function run(Request $request): User
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(CreateUserTask::class)->run($data);
    }
}

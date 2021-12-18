<?php

namespace App\Containers\CoreSection\Authentication\Actions;

use App\Containers\CoreSection\Authentication\Models\Authentication;
use App\Containers\CoreSection\Authentication\Tasks\CreateAuthenticationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateAuthenticationAction extends Action
{
    public function run(Request $request): Authentication
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(CreateAuthenticationTask::class)->run($data);
    }
}

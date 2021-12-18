<?php

namespace App\Containers\CoreSection\Authentication\Actions;

use App\Containers\CoreSection\Authentication\Models\Authentication;
use App\Containers\CoreSection\Authentication\Tasks\UpdateAuthenticationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateAuthenticationAction extends Action
{
    public function run(Request $request): Authentication
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(UpdateAuthenticationTask::class)->run($request->id, $data);
    }
}

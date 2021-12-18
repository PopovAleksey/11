<?php

namespace App\Containers\CoreSection\Authentication\Actions;

use App\Containers\CoreSection\Authentication\Models\Authentication;
use App\Containers\CoreSection\Authentication\Tasks\FindAuthenticationByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindAuthenticationByIdAction extends Action
{
    public function run(Request $request): Authentication
    {
        return app(FindAuthenticationByIdTask::class)->run($request->id);
    }
}

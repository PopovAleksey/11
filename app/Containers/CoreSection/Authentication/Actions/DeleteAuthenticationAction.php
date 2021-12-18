<?php

namespace App\Containers\CoreSection\Authentication\Actions;

use App\Containers\CoreSection\Authentication\Tasks\DeleteAuthenticationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteAuthenticationAction extends Action
{
    public function run(Request $request)
    {
        return app(DeleteAuthenticationTask::class)->run($request->id);
    }
}

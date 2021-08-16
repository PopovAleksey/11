<?php

namespace App\Containers\ConstructorSection\Site\Actions;

use App\Containers\ConstructorSection\Site\Interfaces\Actions\DeleteSiteActionInterface;
use App\Containers\ConstructorSection\Site\Tasks\DeleteSiteTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteSiteAction extends Action implements DeleteSiteActionInterface
{
    public function run(Request $request)
    {
        return app(DeleteSiteTask::class)->run($request->id);
    }
}

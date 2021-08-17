<?php

namespace App\Containers\ConstructorSection\Site\Actions;

use App\Containers\ConstructorSection\Site\Interfaces\Actions\FindSiteByIdActionInterface;
use App\Containers\ConstructorSection\Site\Models\Site;
use App\Containers\ConstructorSection\Site\Tasks\FindSiteByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindSiteByIdAction extends Action implements FindSiteByIdActionInterface
{
    public function run(Request $request): Site
    {
        return app(FindSiteByIdTask::class)->run($request->id);
    }
}

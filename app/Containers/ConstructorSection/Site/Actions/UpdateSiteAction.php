<?php

namespace App\Containers\ConstructorSection\Site\Actions;

use App\Containers\ConstructorSection\Site\Interfaces\Actions\UpdateSiteActionInterface;
use App\Containers\ConstructorSection\Site\Models\Site;
use App\Containers\ConstructorSection\Site\Tasks\UpdateSiteTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateSiteAction extends Action implements UpdateSiteActionInterface
{
    public function run(Request $request): Site
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(UpdateSiteTask::class)->run($request->id, $data);
    }
}

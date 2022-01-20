<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Tasks\GetAllLanguagesTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllLanguagesAction extends Action
{
    public function run(Request $request)
    {
        return app(GetAllLanguagesTask::class)->addRequestCriteria()->run();
    }
}

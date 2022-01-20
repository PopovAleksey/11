<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Tasks\DeleteLanguageTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteLanguageAction extends Action
{
    public function run(Request $request)
    {
        return app(DeleteLanguageTask::class)->run($request->id);
    }
}

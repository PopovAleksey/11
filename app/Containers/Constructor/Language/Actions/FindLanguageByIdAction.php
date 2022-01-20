<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Models\Language;
use App\Containers\Constructor\Language\Tasks\FindLanguageByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindLanguageByIdAction extends Action
{
    public function run(Request $request): Language
    {
        return app(FindLanguageByIdTask::class)->run($request->id);
    }
}

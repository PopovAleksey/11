<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Models\Language;
use App\Containers\Constructor\Language\Tasks\UpdateLanguageTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateLanguageAction extends Action
{
    public function run(Request $request): Language
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(UpdateLanguageTask::class)->run($request->id, $data);
    }
}

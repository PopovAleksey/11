<?php

namespace App\Containers\Constructor\Language\UI\WEB\Controllers;

use App\Containers\Constructor\Language\UI\WEB\Requests\CreateLanguageRequest;
use App\Containers\Constructor\Language\UI\WEB\Requests\DeleteLanguageRequest;
use App\Containers\Constructor\Language\UI\WEB\Requests\GetAllLanguagesRequest;
use App\Containers\Constructor\Language\UI\WEB\Requests\FindLanguageByIdRequest;
use App\Containers\Constructor\Language\UI\WEB\Requests\UpdateLanguageRequest;
use App\Containers\Constructor\Language\UI\WEB\Requests\StoreLanguageRequest;
use App\Containers\Constructor\Language\UI\WEB\Requests\EditLanguageRequest;
use App\Containers\Constructor\Language\Actions\CreateLanguageAction;
use App\Containers\Constructor\Language\Actions\FindLanguageByIdAction;
use App\Containers\Constructor\Language\Actions\GetAllLanguagesAction;
use App\Containers\Constructor\Language\Actions\UpdateLanguageAction;
use App\Containers\Constructor\Language\Actions\DeleteLanguageAction;
use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
    public function index(GetAllLanguagesRequest $request)
    {
        return view('constructor@language::list');
    }

    public function show(FindLanguageByIdRequest $request)
    {
        $language = app(FindLanguageByIdAction::class)->run($request);
        // ..
    }

    public function create(CreateLanguageRequest $request)
    {
        return view('constructor@language::list');
    }

    public function store(StoreLanguageRequest $request)
    {
        $language = app(CreateLanguageAction::class)->run($request);
        // ..
    }

    public function edit(EditLanguageRequest $request)
    {
        return view('constructor@language::list');
        //$language = app(FindLanguageByIdAction::class)->run($request);
        // ..
    }

    public function update(UpdateLanguageRequest $request)
    {
        $language = app(UpdateLanguageAction::class)->run($request);
        // ..
    }

    public function destroy(DeleteLanguageRequest $request)
    {
         $result = app(DeleteLanguageAction::class)->run($request);
         // ..
    }
}

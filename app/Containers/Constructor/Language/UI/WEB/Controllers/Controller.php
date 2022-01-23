<?php

namespace App\Containers\Constructor\Language\UI\WEB\Controllers;

use App\Containers\Constructor\Language\Actions\CreateLanguageAction;
use App\Containers\Constructor\Language\Actions\DeleteLanguageAction;
use App\Containers\Constructor\Language\Actions\UpdateLanguageAction;
use App\Containers\Constructor\Language\UI\WEB\Requests\DeleteLanguageRequest;
use App\Containers\Constructor\Language\UI\WEB\Requests\EditLanguageRequest;
use App\Containers\Constructor\Language\UI\WEB\Requests\StoreLanguageRequest;
use App\Containers\Constructor\Language\UI\WEB\Requests\UpdateLanguageRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Controller extends WebController
{
    public function index(): Factory|View|Application
    {
        return view('constructor@language::list');
    }

    public function show(int $id): Factory|View|Application
    {
        return view('constructor@language::list');

        return response()->json(['test' => 123]);
        #$language = app(FindLanguageByIdAction::class)->run($request);
        // ..
    }

    public function create(): Factory|View|Application
    {
        dd(config('constructor-language.countries'));
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

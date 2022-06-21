<?php

namespace App\Containers\Constructor\Localization\UI\WEB\Controllers;

use App\Containers\Constructor\Localization\Actions\GetAllLocalizationsActionInterface;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Controller extends WebController
{
    public function __construct(
        private GetAllLocalizationsActionInterface     $getAllLocalizationsAction,
        #private CreateLocalizationActionInterface      $createLocalizationAction,
        #private FindLocalizationByIdActionInterface    $findLocalizationByIdAction,
        #private UpdateLocalizationActionInterface      $updateLocalizationAction,
        #private DeleteLocalizationActionInterface      $deleteLocalizationAction
    )
    {
    }

    public function index(): Factory|View|Application
    {
        $localizations = $this->getAllLocalizationsAction->run();

        return view('constructor.base');
    }

    /*public function show(int $id): Factory|View|Application
    {
        $localization = $this->findLocalizationByIdAction->run($id);

        return view('constructor.base');
    }

    public function create(): Factory|View|Application
    {
        return view('constructor.base');
    }

    public function store(StoreLocalizationRequest $request): JsonResponse
    {
        $this->createLocalizationAction->run($request->mapped());

        return response()->json()->setStatusCode(200);
    }

    public function edit(int $id): Factory|View|Application
    {
        $localization = $this->findLocalizationByIdAction->run($id);

        return view('constructor.base');
    }

    public function update(int $id, UpdateLocalizationRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $this->updateLocalizationAction->run($data);

        return response()->json()->setStatusCode(200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteLocalizationAction->run($id);

        return response()->json()->setStatusCode(200);
    }*/
}

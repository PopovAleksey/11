<?php

namespace App\Containers\Constructor\Localization\UI\WEB\Controllers;

use App\Containers\Constructor\Localization\Actions\CreateLocalizationActionInterface;
use App\Containers\Constructor\Localization\Actions\DeleteLocalizationActionInterface;
use App\Containers\Constructor\Localization\Actions\FindLocalizationByIdActionInterface;
use App\Containers\Constructor\Localization\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Localization\Actions\GetAllLocalizationsActionInterface;
use App\Containers\Constructor\Localization\Actions\GetAllThemesActionInterface;
use App\Containers\Constructor\Localization\UI\WEB\Requests\StoreLocalizationRequest;
use App\Containers\Constructor\Localization\UI\WEB\Resources\LocalizationResource;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class Controller extends WebController
{
    public function __construct(
        private readonly GetAllLocalizationsActionInterface  $getAllLocalizationsAction,
        private readonly GetAllLanguagesActionInterface      $getAllLanguagesAction,
        private readonly GetAllThemesActionInterface         $getAllThemesAction,
        private readonly FindLocalizationByIdActionInterface $findLocalizationByIdAction,
        private readonly CreateLocalizationActionInterface   $createLocalizationAction,
        #private UpdateLocalizationActionInterface      $updateLocalizationAction,
        private readonly DeleteLocalizationActionInterface   $deleteLocalizationAction
    )
    {
    }

    public function index(): View|Factory|Redirector|RedirectResponse|Application
    {
        $localizationList = $this->getAllLocalizationsAction->run();
        $languageList     = $this->getAllLanguagesAction->run();
        $themeList        = $this->getAllThemesAction->run();

        if ($languageList->count() === 0) {
            return redirect(route('constructor_language_index'));
        }

        return view('constructor@localization::list', [
            'domain'    => config('app.url'),
            'list'      => $localizationList,
            'languages' => $languageList,
            'themes'    => $themeList,
        ]);
    }

    public function find(int $id): LocalizationResource
    {
        $localization = $this->findLocalizationByIdAction->run($id);

        return LocalizationResource::make($localization);
    }

    public function store(StoreLocalizationRequest $request): JsonResponse
    {
        $localizationId = $this->createLocalizationAction->run($request->mapped());

        return response()
            ->json(['id' => $localizationId])
            ->setStatusCode(200);
    }

    public function update(int $id, StoreLocalizationRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        #$this->updateLocalizationAction->run($data);

        return response()->json()->setStatusCode(200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteLocalizationAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}

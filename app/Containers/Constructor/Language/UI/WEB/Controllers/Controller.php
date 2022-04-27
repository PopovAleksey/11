<?php

namespace App\Containers\Constructor\Language\UI\WEB\Controllers;

use App\Containers\Constructor\Language\Actions\CreateLanguageActionInterface;
use App\Containers\Constructor\Language\Actions\DeleteLanguageActionInterface;
use App\Containers\Constructor\Language\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Language\Actions\GetPossibleLanguagesActionInterface;
use App\Containers\Constructor\Language\Actions\UpdateLanguageActionInterface;
use App\Containers\Constructor\Language\UI\WEB\Requests\StoreLanguageRequest;
use App\Containers\Constructor\Language\UI\WEB\Requests\UpdateLanguageRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class Controller extends WebController
{
    public function __construct(
        private CreateLanguageActionInterface       $createLanguageAction,
        private GetAllLanguagesActionInterface      $getAllLanguagesAction,
        private GetPossibleLanguagesActionInterface $getPossibleLanguagesAction,
        private UpdateLanguageActionInterface       $updateLanguageAction,
        private DeleteLanguageActionInterface       $deleteLanguageAction
    )
    {
    }


    public function index(): Factory|View|Application
    {
        return view('constructor@language::list', [
            'domain'    => config('app.url'),
            'list'      => $this->getAllLanguagesAction->run(),
            'countries' => $this->getPossibleLanguagesAction->run(),
        ]);
    }


    public function store(StoreLanguageRequest $request): JsonResponse
    {
        $this->createLanguageAction->run($request->mapped());

        return response()->json()->setStatusCode(200);
    }


    public function update(int $id, UpdateLanguageRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $this->updateLanguageAction->run($data);

        return response()->json()->setStatusCode(200);
    }


    public function destroy(int $id): JsonResponse
    {
        $this->deleteLanguageAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}

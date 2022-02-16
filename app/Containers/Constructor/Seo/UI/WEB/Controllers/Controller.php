<?php

namespace App\Containers\Constructor\Seo\UI\WEB\Controllers;

use App\Containers\Constructor\Language\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface;
use App\Containers\Constructor\Seo\Actions\GetAllSeoActionInterface;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Controller extends WebController
{
    public function __construct(
        private GetAllSeoActionInterface       $getAllSeoAction,
        private GetAllPagesActionInterface     $getAllPagesAction,
        private GetAllLanguagesActionInterface $getAllLanguagesAction
        /*private CreateSeoActionInterface      $createSeoAction,
        private FindSeoByIdActionInterface    $findSeoByIdAction,
        private UpdateSeoActionInterface      $updateSeoAction,
        private DeleteSeoActionInterface      $deleteSeoAction*/
    )
    {
    }

    public function index(): Factory|View|Application
    {
        $seoLinks  = $this->getAllSeoAction->run();
        $pages     = $this->getAllPagesAction->run(true);
        $languages = $this->getAllLanguagesAction->run()->reject(fn(LanguageDto $language) => $language->isActive() === false);

        return view('constructor@seo::list', [
            'domain'    => config('app.url'),
            'list'      => $seoLinks,
            'pages'     => $pages,
            'languages' => $languages,
        ]);
    }

    /*public function show(int $id): Factory|View|Application
    {
        $seo = $this->findSeoByIdAction->run($id);

        return view('constructor.base');
    }

    public function store(StoreSeoRequest $request): JsonResponse
    {
        $this->createSeoAction->run($request->mapped());

        return response()->json()->setStatusCode(200);
    }

    public function edit(int $id): Factory|View|Application
    {
        $seo = $this->findSeoByIdAction->run($id);

        return view('constructor.base');
    }

    public function update(int $id, UpdateSeoRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $this->updateSeoAction->run($data);

        return response()->json()->setStatusCode(200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteSeoAction->run($id);

        return response()->json()->setStatusCode(200);
    }*/
}

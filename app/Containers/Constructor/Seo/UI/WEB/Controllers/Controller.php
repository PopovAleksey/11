<?php

namespace App\Containers\Constructor\Seo\UI\WEB\Controllers;

use App\Containers\Constructor\Seo\Actions\CreateSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\DeleteSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\FindSeoByIdActionInterface;
use App\Containers\Constructor\Seo\Actions\GetAllSeosActionInterface;
use App\Containers\Constructor\Seo\Actions\UpdateSeoActionInterface;
use App\Containers\Constructor\Seo\UI\WEB\Requests\StoreSeoRequest;
use App\Containers\Constructor\Seo\UI\WEB\Requests\UpdateSeoRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class Controller extends WebController
{
    public function __construct(
        private GetAllSeosActionInterface     $getAllSeosAction,
        private CreateSeoActionInterface      $createSeoAction,
        private FindSeoByIdActionInterface    $findSeoByIdAction,
        private UpdateSeoActionInterface      $updateSeoAction,
        private DeleteSeoActionInterface      $deleteSeoAction
    )
    {
    }

    public function index(): Factory|View|Application
    {
        $seos = $this->getAllSeosAction->run();

        return view('constructor.base');
    }

    public function show(int $id): Factory|View|Application
    {
        $seo = $this->findSeoByIdAction->run($id);

        return view('constructor.base');
    }

    public function create(): Factory|View|Application
    {
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
    }
}

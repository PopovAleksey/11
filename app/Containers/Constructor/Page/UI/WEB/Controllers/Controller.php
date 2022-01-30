<?php

namespace App\Containers\Constructor\Page\UI\WEB\Controllers;

use App\Containers\Constructor\Page\Actions\CreatePageActionInterface;
use App\Containers\Constructor\Page\Actions\DeletePageActionInterface;
use App\Containers\Constructor\Page\Actions\FindPageByIdActionInterface;
use App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface;
use App\Containers\Constructor\Page\Actions\UpdatePageActionInterface;
use App\Containers\Constructor\Page\UI\WEB\Requests\StorePageRequest;
use App\Containers\Constructor\Page\UI\WEB\Requests\UpdatePageRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class Controller extends WebController
{
    public function __construct(
        private GetAllPagesActionInterface  $getAllPagesAction,
        private CreatePageActionInterface   $createPageAction,
        private FindPageByIdActionInterface $findPageByIdAction,
        private UpdatePageActionInterface   $updatePageAction,
        private DeletePageActionInterface   $deletePageAction
    )
    {
    }

    public function index(): Factory|View|Application
    {
        return view('constructor@page::list', [
            'list' => $this->getAllPagesAction->run(),
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view('constructor.base');
    }

    public function store(StorePageRequest $request): JsonResponse
    {
        $pageId = $this->createPageAction->run($request->mapped());

        return response()
            ->json(['id' => $pageId])
            ->setStatusCode(200);
    }

    public function edit(int $id): Factory|View|Application
    {
        $page = $this->findPageByIdAction->run($id, withFields: true);

        return match ($page->getType()) {
            'simple' => view('constructor@page::simple', ['data' => $page]),

        };
    }

    public function update(int $id, UpdatePageRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $page = $this->updatePageAction->run($data);

        return response()
            ->json(['id' => $page->getId()])
            ->setStatusCode(200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deletePageAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}

<?php

namespace App\Containers\Dashboard\Content\UI\WEB\Controllers;

use App\Containers\Dashboard\Content\Actions\CreateContentActionInterface;
use App\Containers\Dashboard\Content\Actions\DeleteContentActionInterface;
use App\Containers\Dashboard\Content\Actions\FindContentByIdActionInterface;
use App\Containers\Dashboard\Content\Actions\GetAllContentsActionInterface;
use App\Containers\Dashboard\Content\Actions\GetMenuListActionInterface;
use App\Containers\Dashboard\Content\Actions\UpdateContentActionInterface;
use App\Containers\Dashboard\Content\UI\WEB\Requests\StoreContentRequest;
use App\Containers\Dashboard\Content\UI\WEB\Requests\UpdateContentRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Controller extends WebController
{
    public function __construct(
        private GetMenuListActionInterface     $getMenuListAction,

        private GetAllContentsActionInterface  $getAllContentsAction,
        private CreateContentActionInterface   $createContentAction,
        private FindContentByIdActionInterface $findContentByIdAction,
        private UpdateContentActionInterface   $updateContentAction,
        private DeleteContentActionInterface   $deleteContentAction
    )
    {
    }

    public function index(): Factory|View|Application
    {
        $contents = $this->getAllContentsAction->run();

        return view('dashboard.base', $this->menuBuilder()->merge(['content' => $contents]));
    }

    private function menuBuilder(): Collection
    {
        $pages = $this->getMenuListAction->run();

        return collect(['menu' => $pages]);
    }

    public function showPage(int $id): Factory|View|Application
    {
        $contents = $this->findContentByIdAction->run($id);

        return view('dashboard.base', $this->menuBuilder()->merge(['contents' => $contents]));
    }

    public function create(): Factory|View|Application
    {
        return view('constructor.base');
    }

    public function store(StoreContentRequest $request): JsonResponse
    {
        $this->createContentAction->run($request->mapped());

        return response()->json()->setStatusCode(200);
    }

    public function edit(int $id): Factory|View|Application
    {
        $content = $this->findContentByIdAction->run($id);

        return view('constructor.base');
    }

    public function update(int $id, UpdateContentRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $this->updateContentAction->run($data);

        return response()->json()->setStatusCode(200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteContentAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}

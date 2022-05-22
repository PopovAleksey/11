<?php

namespace App\Containers\Constructor\Page\UI\WEB\Controllers;

use App\Containers\Constructor\Page\Actions\ActivatePageActionInterface;
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
    /**
     * @param \App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface  $getAllPagesAction
     * @param \App\Containers\Constructor\Page\Actions\CreatePageActionInterface   $createPageAction
     * @param \App\Containers\Constructor\Page\Actions\FindPageByIdActionInterface $findPageByIdAction
     * @param \App\Containers\Constructor\Page\Actions\UpdatePageActionInterface   $updatePageAction
     * @param \App\Containers\Constructor\Page\Actions\DeletePageActionInterface   $deletePageAction
     * @param \App\Containers\Constructor\Page\Actions\ActivatePageActionInterface $activatePageAction
     */
    public function __construct(
        private GetAllPagesActionInterface  $getAllPagesAction,
        private CreatePageActionInterface   $createPageAction,
        private FindPageByIdActionInterface $findPageByIdAction,
        private UpdatePageActionInterface   $updatePageAction,
        private DeletePageActionInterface   $deletePageAction,
        private ActivatePageActionInterface $activatePageAction
    )
    {
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|View|Application
    {
        return view('constructor@page::list', [
            'list' => $this->getAllPagesAction->run(),
        ]);
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $page = $this->findPageByIdAction->run($id, withFields: true);

        return view('constructor@page::edit', ['data' => $page, 'pageId' => $id]);
    }


    /**
     * @param \App\Containers\Constructor\Page\UI\WEB\Requests\StorePageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePageRequest $request): JsonResponse
    {
        $pageId = $this->createPageAction->run($request->mapped());

        return response()
            ->json(['id' => $pageId])
            ->setStatusCode(200);
    }


    /**
     * @param int                                                                $id
     * @param \App\Containers\Constructor\Page\UI\WEB\Requests\UpdatePageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, UpdatePageRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);
        $page = $this->updatePageAction->run($data);

        return response()
            ->json(['id' => $page->getId()])
            ->setStatusCode(200);
    }


    /**
     * @param int                                                                $id
     * @param \App\Containers\Constructor\Page\UI\WEB\Requests\UpdatePageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(int $id, UpdatePageRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);
        $page = $this->activatePageAction->run($data);

        return response()
            ->json(['id' => $page->getId()])
            ->setStatusCode(200);
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->deletePageAction->run($id);

        return response()
            ->json()
            ->setStatusCode(200);
    }
}

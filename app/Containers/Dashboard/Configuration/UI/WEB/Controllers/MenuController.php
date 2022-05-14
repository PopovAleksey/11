<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Controllers;

use App\Containers\Dashboard\Configuration\Actions\ActivateMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\CreateMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\DeleteMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\FindMenuConfigurationByIdActionInterface;
use App\Containers\Dashboard\Configuration\Actions\GetAllMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\UpdateMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\UI\WEB\Requests\ActivateMenuRequest;
use App\Containers\Dashboard\Configuration\UI\WEB\Requests\StoreMenuConfigurationRequest;
use App\Containers\Dashboard\Configuration\UI\WEB\Requests\UpdateMenuConfigurationRequest;
use App\Ship\Parents\Controllers\DashboardController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class MenuController extends DashboardController
{
    /**
     * @param \App\Containers\Dashboard\Configuration\Actions\GetAllMenuConfigurationActionInterface   $allMenuConfigurationAction
     * @param \App\Containers\Dashboard\Configuration\Actions\FindMenuConfigurationByIdActionInterface $findConfigurationByIdAction
     * @param \App\Containers\Dashboard\Configuration\Actions\CreateMenuConfigurationActionInterface   $createMenuConfigurationAction
     * @param \App\Containers\Dashboard\Configuration\Actions\ActivateMenuConfigurationActionInterface $activateMenuConfigurationAction
     * @param \App\Containers\Dashboard\Configuration\Actions\UpdateMenuConfigurationActionInterface   $updateMenuConfigurationAction
     * @param \App\Containers\Dashboard\Configuration\Actions\DeleteMenuConfigurationActionInterface   $deleteMenuConfigurationAction
     */
    public function __construct(
        private GetAllMenuConfigurationActionInterface   $allMenuConfigurationAction,
        private FindMenuConfigurationByIdActionInterface $findConfigurationByIdAction,
        private CreateMenuConfigurationActionInterface   $createMenuConfigurationAction,
        private ActivateMenuConfigurationActionInterface $activateMenuConfigurationAction,
        private UpdateMenuConfigurationActionInterface   $updateMenuConfigurationAction,
        private DeleteMenuConfigurationActionInterface   $deleteMenuConfigurationAction
    )
    {
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|View|Application
    {
        $menu = $this->allMenuConfigurationAction->run();

        return view(
            'dashboard@configuration::menu-list',
            $this->menuBuilder()->merge([
                'templates' => $menu->get('templates'),
                'list'      => $menu->get('list'),
            ]));
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $menuConfiguration = $this->findConfigurationByIdAction->run($id);

        return view(
            'dashboard@configuration::menu-edit',
            $this->menuBuilder()->merge([
                'id'        => $id,
                'data'      => $menuConfiguration->get('data'),
                'list'      => $menuConfiguration->get('list'),
                'templates' => $menuConfiguration->get('templates'),
            ])
        );
    }

    /**
     * @param \App\Containers\Dashboard\Configuration\UI\WEB\Requests\StoreMenuConfigurationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMenuConfigurationRequest $request): JsonResponse
    {
        $menuId = $this->createMenuConfigurationAction->run($request->mapped());

        return response()->json(['id' => $menuId])->setStatusCode(200);
    }

    /**
     * @param int                                                                         $id
     * @param \App\Containers\Dashboard\Configuration\UI\WEB\Requests\ActivateMenuRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(int $id, ActivateMenuRequest $request): JsonResponse
    {
        $data = $request->mapped()->setId($id);

        $this->activateMenuConfigurationAction->run($data);

        return response()->json()->setStatusCode(200);
    }

    /**
     * @param int                                                                                    $id
     * @param \App\Containers\Dashboard\Configuration\UI\WEB\Requests\UpdateMenuConfigurationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, UpdateMenuConfigurationRequest $request): JsonResponse
    {
        $this->updateMenuConfigurationAction->run($request->mapped()->setId($id));

        return response()->json()->setStatusCode(200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->deleteMenuConfigurationAction->run($id);

        return response()->json()->setStatusCode(200);
    }
}

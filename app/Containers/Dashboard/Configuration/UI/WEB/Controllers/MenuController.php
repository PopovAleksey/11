<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Controllers;

use App\Containers\Dashboard\Configuration\Actions\FindConfigurationByIdActionInterface;
use App\Containers\Dashboard\Configuration\Actions\GetAllMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\UpdateMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\UI\WEB\Requests\UpdateMenuConfigurationRequest;
use App\Ship\Parents\Controllers\DashboardController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class MenuController extends DashboardController
{
    /**
     * @param \App\Containers\Dashboard\Configuration\Actions\GetAllMenuConfigurationActionInterface $allMenuConfigurationAction
     * @param \App\Containers\Dashboard\Configuration\Actions\FindConfigurationByIdActionInterface   $findConfigurationByIdAction
     * @param \App\Containers\Dashboard\Configuration\Actions\UpdateMenuConfigurationActionInterface $updateMenuConfigurationAction
     */
    public function __construct(
        private GetAllMenuConfigurationActionInterface $allMenuConfigurationAction,
        private FindConfigurationByIdActionInterface   $findConfigurationByIdAction,
        private UpdateMenuConfigurationActionInterface $updateMenuConfigurationAction
    )
    {
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|View|Application
    {
        $list = $this->allMenuConfigurationAction->run();

        return view('dashboard@configuration::menu-list', $this->menuBuilder()->merge(['list' => $list]));
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $list = $this->findConfigurationByIdAction->run($id);

        return view('dashboard@configuration::menu-edit', $this->menuBuilder()->merge(['list' => $list]));
    }

    /**
     * @param \App\Containers\Dashboard\Configuration\UI\WEB\Requests\UpdateMenuConfigurationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMenuConfigurationRequest $request): JsonResponse
    {
        $this->updateMenuConfigurationAction->run($request->mapped());

        return response()->json()->setStatusCode(200);
    }
}

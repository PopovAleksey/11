<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Controllers;

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
    public function __construct(
        private GetAllMenuConfigurationActionInterface $allMenuConfigurationAction,
        private UpdateMenuConfigurationActionInterface $updateMenuConfigurationAction
    )
    {
    }

    public function index(): Factory|View|Application
    {
        $list = $this->allMenuConfigurationAction->run();

        return view('dashboard@configuration::menu', $this->menuBuilder()->merge(['list' => $list]));
    }

    public function update(UpdateMenuConfigurationRequest $request): JsonResponse
    {
        $this->updateMenuConfigurationAction->run($request->mapped());

        return response()->json()->setStatusCode(200);
    }
}

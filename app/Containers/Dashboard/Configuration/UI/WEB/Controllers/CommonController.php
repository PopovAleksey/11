<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Controllers;

use App\Containers\Dashboard\Configuration\Actions\GetAllCommonConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\UpdateMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\UI\WEB\Requests\UpdateMenuConfigurationRequest;
use App\Ship\Parents\Controllers\DashboardController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CommonController extends DashboardController
{
    /**
     * @param \App\Containers\Dashboard\Configuration\Actions\GetAllCommonConfigurationActionInterface $allCommonConfigurationAction
     * @param \App\Containers\Dashboard\Configuration\Actions\UpdateMenuConfigurationActionInterface   $updateMenuConfigurationAction
     */
    public function __construct(
        private GetAllCommonConfigurationActionInterface $allCommonConfigurationAction,
        private UpdateMenuConfigurationActionInterface   $updateMenuConfigurationAction
    )
    {
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|View|Application
    {
        $configList = $this->allCommonConfigurationAction->run();

        return view('dashboard@configuration::common', $this->menuBuilder()->merge(['configs' => $configList]));
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

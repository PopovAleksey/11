<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Controllers;

use App\Containers\Dashboard\Configuration\Actions\Common\GetAllCommonConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\Common\UpdateCommonConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\UI\WEB\Requests\UpdateCommonConfigurationRequest;
use App\Ship\Parents\Controllers\DashboardController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CommonController extends DashboardController
{
    public function __construct(
        private readonly GetAllCommonConfigurationActionInterface $allCommonConfigurationAction,
        private readonly UpdateCommonConfigurationActionInterface $updateCommonConfigurationAction
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
     * @param \App\Containers\Dashboard\Configuration\UI\WEB\Requests\UpdateCommonConfigurationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCommonConfigurationRequest $request): JsonResponse
    {
        $this->updateCommonConfigurationAction->run($request->mapped());

        return response()->json()->setStatusCode(200);
    }
}

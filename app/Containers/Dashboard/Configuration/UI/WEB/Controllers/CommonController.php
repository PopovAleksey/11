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
    public function __construct(
        private GetAllCommonConfigurationActionInterface $allCommonConfigurationAction,
        private UpdateMenuConfigurationActionInterface   $updateMenuConfigurationAction
    )
    {
    }

    public function index(): Factory|View|Application
    {
        $list = $this->allCommonConfigurationAction->run();
        dump($list);

        return view('dashboard@configuration::common', $this->menuBuilder()->merge(['list' => $list]));
    }

    public function update(UpdateMenuConfigurationRequest $request): JsonResponse
    {
        $this->updateMenuConfigurationAction->run($request->mapped());

        return response()->json()->setStatusCode(200);
    }
}

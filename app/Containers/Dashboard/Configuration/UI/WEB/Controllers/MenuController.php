<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Controllers;

use App\Containers\Dashboard\Configuration\Actions\GetAllMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\UI\WEB\Requests\UpdateMenuConfigurationRequest;
use App\Containers\Dashboard\Content\Actions\GetMenuListActionInterface;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class MenuController extends WebController
{
    public function __construct(
        private GetMenuListActionInterface             $getMenuListAction,
        private GetAllMenuConfigurationActionInterface $allMenuConfigurationAction
    )
    {
    }

    public function index(): Factory|View|Application
    {
        $list = $this->allMenuConfigurationAction->run();

        return view('dashboard@configuration::menu', $this->menuBuilder()->merge(['list' => $list]));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function menuBuilder(): Collection
    {
        return collect(['menu' => $this->getMenuListAction->run()]);
    }

    /**
     * @param \App\Containers\Dashboard\Configuration\UI\WEB\Requests\UpdateMenuConfigurationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMenuConfigurationRequest $request): JsonResponse
    {
        $data = $request->mapped();

        return response()->json()->setStatusCode(200);
    }
}

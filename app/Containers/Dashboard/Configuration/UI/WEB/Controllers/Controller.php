<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Controllers;

use App\Containers\Dashboard\Content\Actions\GetMenuListActionInterface;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class Controller extends WebController
{
    public function __construct(
        private GetMenuListActionInterface $getMenuListAction
    )
    {
    }

    public function menu(): Factory|View|Application
    {
        return view('dashboard.base', $this->menuBuilder());
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function menuBuilder(): Collection
    {
        return collect(['menu' => $this->getMenuListAction->run()]);
    }
}

<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Controller extends WebController
{
    public function __construct()
    {
    }

    public function menu(): Factory|View|Application
    {
        return view('constructor.base');
    }
}

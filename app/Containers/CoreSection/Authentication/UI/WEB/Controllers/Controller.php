<?php

namespace App\Containers\CoreSection\Authentication\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use React\Promise\Promise;

class Controller extends WebController
{
    public function loginForm(): Factory|View|Application
    {
        return view('coreSection@authentication::login');
    }
}

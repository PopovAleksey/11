<?php

use App\Containers\Dashboard\Configuration\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/menu', [Controller::class, 'menu'])
    ->name('dashboard_configuration_menu')
    ->middleware(['auth:web']);


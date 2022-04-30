<?php

use App\Containers\Dashboard\Configuration\UI\WEB\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get(config('apiato.link.dashboard') . '/configurations/menu', [MenuController::class, 'index'])
    ->name('dashboard_configuration_menu')
    ->middleware(['auth:web']);

Route::patch(config('apiato.link.dashboard') . '/configurations/menu', [MenuController::class, 'update'])
    ->name('dashboard_configuration_menu_update')
    ->middleware(['auth:web']);
<?php

use App\Containers\Dashboard\Configuration\UI\WEB\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard/configurations/menu', [MenuController::class, 'index'])
    ->name('dashboard_configuration_menu')
    ->middleware(['auth:web']);

Route::patch('dashboard/configurations/menu', [MenuController::class, 'update'])
    ->name('dashboard_configuration_menu_update')
    ->middleware(['auth:web']);
<?php

use App\Containers\Dashboard\Configuration\UI\WEB\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get(config('apiato.link.dashboard') . '/configurations/menus', [MenuController::class, 'index'])
    ->name('dashboard_configuration_menu')
    ->middleware(['auth:web']);

Route::get(config('apiato.link.dashboard') . '/configurations/menu/{id}', [MenuController::class, 'edit'])
    ->name('dashboard_configuration_menu_edit')
    ->middleware(['auth:web']);

Route::post(config('apiato.link.dashboard') . '/configurations/menu', [MenuController::class, 'store'])
    ->name('dashboard_configuration_menu_store')
    ->middleware(['auth:web']);

Route::patch(config('apiato.link.constructor') . '/configurations/menu/{id}', [MenuController::class, 'activate'])
    ->name('dashboard_configuration_menu_activate')
    ->middleware(['auth:web']);

Route::patch(config('apiato.link.dashboard') . '/configurations/menu/{id}', [MenuController::class, 'update'])
    ->name('dashboard_configuration_menu_update')
    ->middleware(['auth:web']);

Route::delete('configurations/{id}', [MenuController::class, 'destroy'])
    ->name('dashboard_configuration_menu_destroy')
    ->middleware(['auth:web']);
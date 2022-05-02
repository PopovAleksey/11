<?php

use App\Containers\Dashboard\Configuration\UI\WEB\Controllers\CommonController;
use Illuminate\Support\Facades\Route;

Route::get(config('apiato.link.dashboard') . '/configurations/common', [CommonController::class, 'index'])
    ->name('dashboard_configuration_common')
    ->middleware(['auth:web']);

Route::patch(config('apiato.link.dashboard') . '/configurations/common', [CommonController::class, 'update'])
    ->name('dashboard_configuration_common_update')
    ->middleware(['auth:web']);
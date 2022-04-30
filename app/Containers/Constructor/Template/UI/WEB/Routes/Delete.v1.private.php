<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTemplate;
use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTheme;
use Illuminate\Support\Facades\Route;

Route::delete(config('apiato.link.constructor') . '/theme/{id}', [ControllerTheme::class, 'destroy'])
    ->name('constructor_theme_destroy')
    ->middleware(['auth:web']);

Route::delete(config('apiato.link.constructor') . '/template/{id}', [ControllerTemplate::class, 'destroy'])
    ->name('constructor_template_destroy')
    ->middleware(['auth:web']);


<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTemplate;
use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTheme;
use Illuminate\Support\Facades\Route;

Route::post('constructor/theme/store', [ControllerTheme::class, 'store'])
    ->name('constructor_theme_store')
    ->middleware(['auth:web']);

Route::post('constructor/templates/store', [ControllerTemplate::class, 'store'])
    ->name('constructor_template_store')
    ->middleware(['auth:web']);


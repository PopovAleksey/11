<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTemplate;
use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTheme;
use Illuminate\Support\Facades\Route;

Route::patch('constructor/templates/{id}', [ControllerTemplate::class, 'update'])
    ->name('constructor_template_update')
    ->middleware(['auth:web']);


Route::patch('constructor/theme/activate/{id}', [ControllerTheme::class, 'activate'])
    ->name('constructor_theme_activate')
    ->middleware(['auth:web']);
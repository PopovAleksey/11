<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTemplate;
use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTheme;
use Illuminate\Support\Facades\Route;

Route::get('constructor/theme/{id}', [ControllerTheme::class, 'show'])
    ->name('constructor_theme_show')
    ->middleware(['auth:web']);

Route::get('constructor/templates/{id}', [ControllerTemplate::class, 'show'])
    ->name('constructor_template_show')
    ->middleware(['auth:web']);


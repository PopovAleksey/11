<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTemplate;
use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTheme;
use Illuminate\Support\Facades\Route;

Route::get('constructor/theme/create', [ControllerTheme::class, 'create'])
    ->name('constructor_theme_create')
    ->middleware(['auth:web']);

Route::get('constructor/templates/create', [ControllerTemplate::class, 'create'])
    ->name('constructor_template_create')
    ->middleware(['auth:web']);
<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTemplate;
use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTheme;
use Illuminate\Support\Facades\Route;

Route::get('constructor/theme/{id}/edit', [ControllerTheme::class, 'edit'])
    ->name('constructor_theme_edit')
    ->middleware(['auth:web']);

Route::get('constructor/templates/{id}/edit', [ControllerTemplate::class, 'edit'])
    ->name('constructor_template_edit')
    ->middleware(['auth:web']);


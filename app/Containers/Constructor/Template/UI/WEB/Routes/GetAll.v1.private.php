<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\ControllerTheme;
use Illuminate\Support\Facades\Route;

Route::get(config('apiato.link.constructor') . '/themes', [ControllerTheme::class, 'index'])
    ->name('constructor_template_index')
    ->middleware(['auth:web']);


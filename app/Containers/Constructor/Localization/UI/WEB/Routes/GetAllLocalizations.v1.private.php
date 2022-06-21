<?php

use App\Containers\Constructor\Localization\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get(config('apiato.link.constructor') . '/localizations', [Controller::class, 'index'])
    ->name('constructor_localization_index')
    ->middleware(['auth:web']);


<?php

use App\Containers\Constructor\Localization\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post(config('apiato.link.constructor') . '/localizations/store', [Controller::class, 'store'])
    ->name('constructor_localization_store')
    ->middleware(['auth:web']);


<?php

use App\Containers\Constructor\Localization\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete(config('apiato.link.constructor') . '/localizations/{id}', [Controller::class, 'destroy'])
    ->name('constructor_localization_destroy')
    ->middleware(['auth:web']);


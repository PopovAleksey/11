<?php

use App\Containers\Constructor\Localization\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get(config('apiato.link.constructor') . '/localizations/{id}', [Controller::class, 'find'])
    ->name('constructor_localization_find')
    ->middleware(['auth:web']);


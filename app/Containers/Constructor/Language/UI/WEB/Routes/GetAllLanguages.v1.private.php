<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get(config('apiato.link.constructor') . '/languages', [Controller::class, 'index'])
    ->name('constructor_language_index')
    ->middleware(['auth:web']);

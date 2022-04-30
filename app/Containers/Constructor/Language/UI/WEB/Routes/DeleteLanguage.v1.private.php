<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete(config('apiato.link.constructor') . '/languages/{id}', [Controller::class, 'destroy'])
    ->name('constructor_language_destroy')
    ->middleware(['auth:web']);

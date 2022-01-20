<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('constructor/languages/{id}', [Controller::class, 'destroy'])
    ->name('constructor_language_destroy')
    ->middleware(['auth:web']);


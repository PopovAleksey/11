<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/languages', [Controller::class, 'index'])
    ->name('constructor_language_index')
    ->middleware(['auth:web']);

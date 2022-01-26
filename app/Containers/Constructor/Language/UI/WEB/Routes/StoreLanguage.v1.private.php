<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('constructor/languages/store', [Controller::class, 'store'])
    ->name('constructor_language_store')
    ->middleware(['auth:web']);

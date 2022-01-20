<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('constructor')
    ->group(static function () {
        Route::get('languages', [Controller::class, 'index'])
            ->name('constructor_language_index')
            ->middleware(['auth:web']);
    });

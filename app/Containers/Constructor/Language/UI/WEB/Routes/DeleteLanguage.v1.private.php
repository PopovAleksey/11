<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('constructor')
    ->group(static function () {
        Route::delete('languages/{id}', [Controller::class, 'destroy'])
            ->name('constructor_language_destroy')
            ->middleware(['auth:web']);
    });


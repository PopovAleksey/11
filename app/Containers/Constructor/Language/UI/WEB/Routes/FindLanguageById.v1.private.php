<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('constructor')
    ->group(static function () {
        Route::get('languages/{id}', [Controller::class, 'show'])
            ->name('constructor_language_show')
            ->middleware(['auth:web']);
    });

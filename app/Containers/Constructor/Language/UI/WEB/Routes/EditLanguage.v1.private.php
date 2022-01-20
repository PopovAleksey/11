<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('constructor')
    ->group(static function () {
        Route::get('languages/{id}/edit', [Controller::class, 'edit'])
            ->name('constructor_language_edit')
            ->middleware(['auth:web']);
    });

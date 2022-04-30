<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch(config('apiato.link.constructor') . '/languages/{id}', [Controller::class, 'update'])
    ->name('constructor_language_update')
    ->middleware(['auth:web']);

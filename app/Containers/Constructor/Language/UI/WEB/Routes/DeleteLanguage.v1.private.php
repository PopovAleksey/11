<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('languages/{id}', [Controller::class, 'destroy'])
    ->name('web_language_destroy')
    ->middleware(['auth:web']);


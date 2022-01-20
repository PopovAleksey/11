<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('languages/store', [Controller::class, 'store'])
    ->name('web_language_store')
    ->middleware(['auth:web']);


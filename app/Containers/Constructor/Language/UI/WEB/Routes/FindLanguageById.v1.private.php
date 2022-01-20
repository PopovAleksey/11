<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('languages/{id}', [Controller::class, 'show'])
    ->name('web_language_show')
    ->middleware(['auth:web']);


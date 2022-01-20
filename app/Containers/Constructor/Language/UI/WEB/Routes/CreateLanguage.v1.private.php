<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('languages/create', [Controller::class, 'create'])
    ->name('web_language_create')
    ->middleware(['auth:web']);


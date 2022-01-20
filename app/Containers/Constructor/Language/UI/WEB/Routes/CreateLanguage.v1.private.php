<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/languages/create', [Controller::class, 'create'])
    ->name('constructor_language_create')
    ->middleware(['auth:web']);
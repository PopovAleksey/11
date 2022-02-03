<?php

use App\Containers\Constructor\Page\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('constructor/pages/{id}', [Controller::class, 'update'])
    ->name('constructor_page_update')
    ->middleware(['auth:web']);

Route::patch('constructor/pages/activate/{id}', [Controller::class, 'activate'])
    ->name('constructor_page_activate')
    ->middleware(['auth:web']);
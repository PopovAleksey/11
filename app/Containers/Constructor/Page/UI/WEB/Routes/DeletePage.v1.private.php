<?php

use App\Containers\Constructor\Page\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete(config('apiato.link.constructor') . '/pages/{id}', [Controller::class, 'destroy'])
    ->name('constructor_page_destroy')
    ->middleware(['auth:web']);


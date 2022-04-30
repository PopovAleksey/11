<?php

use App\Containers\Constructor\Page\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get(config('apiato.link.constructor') . '/pages', [Controller::class, 'index'])
    ->name('constructor_page_index')
    ->middleware(['auth:web']);


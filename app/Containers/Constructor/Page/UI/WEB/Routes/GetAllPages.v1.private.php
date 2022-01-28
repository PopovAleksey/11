<?php

use App\Containers\Constructor\Page\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/pages', [Controller::class, 'index'])
    ->name('constructor_page_index')
    ->middleware(['auth:web']);


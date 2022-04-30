<?php

use App\Containers\Constructor\Page\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post(config('apiato.link.constructor') . '/pages/store', [Controller::class, 'store'])
    ->name('constructor_page_store')
    ->middleware(['auth:web']);


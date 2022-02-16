<?php

use App\Containers\Constructor\Seo\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/seo', [Controller::class, 'index'])
    ->name('constructor_seo_index')
    ->middleware(['auth:web']);


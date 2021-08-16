<?php

use App\Containers\ConstructorSection\Site\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/sites', [Controller::class, 'index'])
    ->middleware(['auth:web']);

Route::get('constructor', [Controller::class, 'index'])
    ->name('web_site_index')
    ->middleware(['auth:web']);

<?php

use App\Containers\Constructor\Seo\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('constructor/seo/{id}', [Controller::class, 'update'])
    ->name('constructor_seo_update')
    ->middleware(['auth:web']);


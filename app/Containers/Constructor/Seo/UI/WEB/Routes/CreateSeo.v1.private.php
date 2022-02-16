<?php

use App\Containers\Constructor\Seo\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('seo/create', [Controller::class, 'create'])
    ->name('web_seo_create')
    ->middleware(['auth:web']);


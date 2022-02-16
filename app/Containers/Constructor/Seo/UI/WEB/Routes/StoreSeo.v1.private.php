<?php

use App\Containers\Constructor\Seo\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('seo/store', [Controller::class, 'store'])
    ->name('web_seo_store')
    ->middleware(['auth:web']);


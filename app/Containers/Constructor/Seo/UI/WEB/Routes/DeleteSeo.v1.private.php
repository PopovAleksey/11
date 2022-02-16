<?php

use App\Containers\Constructor\Seo\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('seo/{id}', [Controller::class, 'destroy'])
    ->name('web_seo_destroy')
    ->middleware(['auth:web']);


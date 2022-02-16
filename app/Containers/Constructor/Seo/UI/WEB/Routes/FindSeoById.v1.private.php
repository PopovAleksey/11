<?php

use App\Containers\Constructor\Seo\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('seo/{id}', [Controller::class, 'show'])
    ->name('web_seo_show')
    ->middleware(['auth:web']);


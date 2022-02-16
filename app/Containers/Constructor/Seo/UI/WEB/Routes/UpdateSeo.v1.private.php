<?php

use App\Containers\Constructor\Seo\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('seo/{id}', [Controller::class, 'update'])
    ->name('web_seo_update')
    ->middleware(['auth:web']);


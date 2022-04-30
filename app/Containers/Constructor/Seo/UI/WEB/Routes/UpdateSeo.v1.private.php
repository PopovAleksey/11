<?php

use App\Containers\Constructor\Seo\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch(config('apiato.link.constructor') . '/seo/{id}', [Controller::class, 'update'])
    ->name('constructor_seo_update')
    ->middleware(['auth:web']);


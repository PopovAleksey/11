<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post(config('apiato.link.dashboard') . '/content/store', [Controller::class, 'store'])
    ->name('dashboard_content_store')
    ->middleware(['auth:web']);


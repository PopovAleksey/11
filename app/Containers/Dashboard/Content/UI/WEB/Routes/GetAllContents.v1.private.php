<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('dashboard/contents', [Controller::class, 'index'])
    ->name('dashboard_content_index')
    ->middleware(['auth:web']);


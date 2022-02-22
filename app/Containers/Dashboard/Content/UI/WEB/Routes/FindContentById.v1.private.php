<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('dashboard/contents/{id}', [Controller::class, 'show'])
    ->name('dashboard_content_show')
    ->middleware(['auth:web']);


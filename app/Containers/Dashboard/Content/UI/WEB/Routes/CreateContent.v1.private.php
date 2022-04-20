<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('dashboard/page/{pageId}/create', [Controller::class, 'create'])
    ->name('dashboard_content_create')
    ->middleware(['auth:web']);


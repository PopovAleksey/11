<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('dashboard/contents/{id}/edit', [Controller::class, 'edit'])
    ->name('dashboard_content_edit')
    ->middleware(['auth:web']);


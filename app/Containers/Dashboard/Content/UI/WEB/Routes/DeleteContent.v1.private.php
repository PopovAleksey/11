<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('dashboard/contents/{id}', [Controller::class, 'destroy'])
    ->name('dashboard_content_destroy')
    ->middleware(['auth:web']);


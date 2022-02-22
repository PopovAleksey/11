<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('dashboard/contents/{id}', [Controller::class, 'update'])
    ->name('dashboard_content_update')
    ->middleware(['auth:web']);


<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('dashboard/page/{id}', [Controller::class, 'showPage'])
    ->name('dashboard_page_show')
    ->middleware(['auth:web']);

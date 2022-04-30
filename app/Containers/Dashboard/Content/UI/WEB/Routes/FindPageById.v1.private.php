<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get(config('apiato.link.dashboard') . '/page/{id}', [Controller::class, 'showPage'])
    ->name('dashboard_page_show')
    ->middleware(['auth:web']);


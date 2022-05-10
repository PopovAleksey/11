<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix(config('apiato.link.dashboard') . '/page/{id}')
    ->middleware(['auth:web'])
    ->group(function () {
        Route::get('/content/{contentId}', [Controller::class, 'showPage'])->name('dashboard_page_content_show');
        Route::get('', [Controller::class, 'showPage'])->name('dashboard_page_show');
    });


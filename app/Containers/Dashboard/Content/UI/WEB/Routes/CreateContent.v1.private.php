<?php

use App\Containers\Dashboard\Content\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix(config('apiato.link.dashboard') . '/page/{pageId}')->middleware(['auth:web'])->group(function () {
    Route::get('/create', [Controller::class, 'create'])->name('dashboard_content_create');
    Route::get('/content/{contentId}/create', [Controller::class, 'create'])->name('dashboard_content_page_create');
});


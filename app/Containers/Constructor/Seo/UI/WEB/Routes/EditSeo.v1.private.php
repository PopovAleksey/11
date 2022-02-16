<?php

use App\Containers\Constructor\Seo\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('seo/{id}/edit', [Controller::class, 'edit'])
    ->name('web_seo_edit')
    ->middleware(['auth:web']);


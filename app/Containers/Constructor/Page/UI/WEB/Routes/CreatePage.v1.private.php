<?php

use App\Containers\Constructor\Page\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('pages/create', [Controller::class, 'create'])
    ->name('web_page_create')
    ->middleware(['auth:web']);


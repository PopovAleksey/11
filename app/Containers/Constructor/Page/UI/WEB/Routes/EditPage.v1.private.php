<?php

use App\Containers\Constructor\Page\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/pages/{id}/edit', [Controller::class, 'edit'])
    ->name('constructor_page_edit')
    ->middleware(['auth:web']);


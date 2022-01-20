<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('languages/{id}/edit', [Controller::class, 'edit'])
    ->name('web_language_edit')
    ->middleware(['auth:web']);


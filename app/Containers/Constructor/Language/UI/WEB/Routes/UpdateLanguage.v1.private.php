<?php

use App\Containers\Constructor\Language\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('languages/{id}', [Controller::class, 'update'])
    ->name('web_language_update')
    ->middleware(['auth:web']);


<?php

use App\Containers\CoreSection\User\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('users', [Controller::class, 'index'])
    ->name('web_user_index')
    ->middleware(['auth:web']);


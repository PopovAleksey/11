<?php

use App\Containers\CoreSection\Authentication\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('auth', [Controller::class, 'loginForm'])
    ->name('web_authentication_index')
    ;//->middleware(['auth:web']);


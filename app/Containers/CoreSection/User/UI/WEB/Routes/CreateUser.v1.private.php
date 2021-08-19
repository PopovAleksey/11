<?php

use App\Containers\CoreSection\User\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('users/create', [Controller::class, 'create'])
    ->name('web_user_create')
    ->middleware(['auth:web']);


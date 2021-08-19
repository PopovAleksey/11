<?php

use App\Containers\CoreSection\User\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('users/{id}', [Controller::class, 'show'])
    ->name('web_user_show')
    ->middleware(['auth:web']);


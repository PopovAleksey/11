<?php

use App\Containers\CoreSection\User\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('users/{id}', [Controller::class, 'destroy'])
    ->name('web_user_destroy')
    ->middleware(['auth:web']);


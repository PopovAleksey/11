<?php

use App\Containers\CoreSection\User\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('users/store', [Controller::class, 'store'])
    ->name('web_user_store')
    ->middleware(['auth:web']);


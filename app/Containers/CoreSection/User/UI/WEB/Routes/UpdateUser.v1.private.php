<?php

use App\Containers\CoreSection\User\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('users/{id}', [Controller::class, 'update'])
    ->name('web_user_update')
    ->middleware(['auth:web']);


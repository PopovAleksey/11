<?php

use App\Containers\CoreSection\User\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('users/{id}/edit', [Controller::class, 'edit'])
    ->name('web_user_edit')
    ->middleware(['auth:web']);


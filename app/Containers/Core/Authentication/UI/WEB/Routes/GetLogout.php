<?php

use App\Containers\Core\Authentication\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/logout', [Controller::class, 'logout'])
    ->name('logout');

<?php

use App\Containers\AppSection\Authentication\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('login', [Controller::class, 'showLoginPage'])
    ->name('login')
    ->middleware(['guest']);


Route::get('debug-sentry', static function () {
    dump(123213123);
    throw new \App\Containers\AppSection\Authentication\Exceptions\LoginFailedException("Test Lost");
});
<?php

use App\Containers\Core\Authentication\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('oauth/google/callback', [Controller::class, 'googleCallback'])
    ->name('oauth_google_callback')
    ->middleware(['guest']);

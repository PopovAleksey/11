<?php

use App\Containers\ConstructorSection\Site\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('sites/create', [Controller::class, 'create'])
    ->name('web_site_create')
    ->middleware(['auth:web']);


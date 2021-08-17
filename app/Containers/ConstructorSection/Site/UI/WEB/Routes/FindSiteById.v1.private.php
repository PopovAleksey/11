<?php

use App\Containers\ConstructorSection\Site\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/sites/{id}', [Controller::class, 'show'])
    ->name('web_site_show')
    ->middleware(['auth:web']);


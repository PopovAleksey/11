<?php

use App\Containers\ConstructorSection\Site\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('sites/store', [Controller::class, 'store'])
    ->name('web_site_store')
    ->middleware(['auth:web']);


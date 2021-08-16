<?php

use App\Containers\ConstructorSection\Site\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('sites/{id}', [Controller::class, 'destroy'])
    ->name('web_site_destroy')
    ->middleware(['auth:web']);


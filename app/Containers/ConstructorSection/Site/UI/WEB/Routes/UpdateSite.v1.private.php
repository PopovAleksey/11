<?php

use App\Containers\ConstructorSection\Site\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('sites/{id}', [Controller::class, 'update'])
    ->name('web_site_update')
    ->middleware(['auth:web']);


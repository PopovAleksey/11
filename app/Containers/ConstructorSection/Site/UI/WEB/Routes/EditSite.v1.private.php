<?php

use App\Containers\ConstructorSection\Site\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('sites/{id}/edit', [Controller::class, 'edit'])
    ->name('web_site_edit')
    ->middleware(['auth:web']);


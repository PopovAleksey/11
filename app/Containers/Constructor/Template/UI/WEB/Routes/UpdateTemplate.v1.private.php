<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('constructor/templates/{id}', [Controller::class, 'update'])
    ->name('constructor_template_update')
    ->middleware(['auth:web']);


Route::patch('constructor/templates/activate/{id}', [Controller::class, 'activate'])
    ->name('constructor_templates_activate')
    ->middleware(['auth:web']);
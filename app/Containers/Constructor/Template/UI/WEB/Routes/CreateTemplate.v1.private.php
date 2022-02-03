<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/templates/create', [Controller::class, 'create'])
    ->name('constructor_template_create')
    ->middleware(['auth:web']);


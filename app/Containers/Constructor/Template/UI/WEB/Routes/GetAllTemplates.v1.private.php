<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/templates', [Controller::class, 'index'])
    ->name('constructor_template_index')
    ->middleware(['auth:web']);


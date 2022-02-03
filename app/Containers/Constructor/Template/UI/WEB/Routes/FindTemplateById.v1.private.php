<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/templates/{id}', [Controller::class, 'show'])
    ->name('constructor_template_show')
    ->middleware(['auth:web']);


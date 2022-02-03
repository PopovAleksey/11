<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('constructor/templates/{id}', [Controller::class, 'destroy'])
    ->name('constructor_template_destroy')
    ->middleware(['auth:web']);


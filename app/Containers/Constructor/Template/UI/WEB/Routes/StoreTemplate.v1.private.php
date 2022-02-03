<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('constructor/templates/store', [Controller::class, 'store'])
    ->name('constructor_template_store')
    ->middleware(['auth:web']);


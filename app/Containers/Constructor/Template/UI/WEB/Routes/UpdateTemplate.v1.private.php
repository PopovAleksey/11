<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('constructor/templates/{id}', [Controller::class, 'update'])
    ->name('constructor_template_update')
    ->middleware(['auth:web']);


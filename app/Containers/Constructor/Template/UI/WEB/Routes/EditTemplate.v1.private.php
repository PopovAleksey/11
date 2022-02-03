<?php

use App\Containers\Constructor\Template\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('constructor/templates/{id}/edit', [Controller::class, 'edit'])
    ->name('constructor_template_edit')
    ->middleware(['auth:web']);


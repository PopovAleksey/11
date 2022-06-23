<?php

use App\Containers\Constructor\Localization\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch(config('apiato.link.constructor') . '/localizations/{id}', [Controller::class, 'update'])
    ->name('constructors_localization_update')
    ->middleware(['auth:web']);


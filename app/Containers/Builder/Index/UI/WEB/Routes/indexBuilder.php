<?php

use App\Containers\Builder\Index\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/{language?}/{seoLink?}', [Controller::class, 'index'])->name('builder_index_page');


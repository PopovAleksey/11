<?php

use App\Containers\Builder\Index\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/{language?}/{seoLink?}', [Controller::class, 'index'])
    ->where([
        #'language' => '^((?!constructor|dashboard).)*$',
        'language' => '[A-Za-z]{2}',
        'seoLink' => '[A-Za-z0-9\-_]+'
    ])
    ->name('builder_index_page');


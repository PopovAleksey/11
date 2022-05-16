<?php

use App\Containers\Builder\Index\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/{themeName}/{type}/{file}', [Controller::class, 'file'])
    ->where(['type' => '(css|js)'])
    ->name('builder_js_page');

Route::get('/{language?}/{seoLink?}', [Controller::class, 'index'])
    ->where([
        'language' => '[A-Za-z]{2}',
        'seoLink' => '[A-Za-z0-9\-_]+'
    ])
    ->name('builder_index_page');


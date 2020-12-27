<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::as('SignIn')->post('sign-in', [UserController::class, 'signIn']);

Route::middleware('auth:sanctum')->group(function () {
    Route::as('Info')->get('/', [UserController::class, 'info']);
    Route::as('Token')->post('token', [UserController::class, 'getToken']);
});

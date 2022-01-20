<?php

/**
 * @OA\Info(
 *     title="Page Constructor",
 *     version="1.0.1"
 * )
 */

/**
 * @apiGroup           User
 * @apiName            createAdmin
 * @api                {post} /v1/admins Create Admin type Users
 * @apiDescription     Create non client users for the Dashboard.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email
 * @apiParam           {String}  password
 * @apiParam           {String}  name
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\Core\User\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/**
 * @OA\Get(
 *     path="/v1/admins",
 *     @OA\Response(response="201", description="Чтобы как-то начать ;)")
 * )
 */
Route::post('admins', [Controller::class, 'createAdmin'])
    ->name('api_user_create_admin')
    ->middleware(['auth:api']);

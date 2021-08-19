<?php

/**
 * @apiGroup           User
 * @apiName            getAllUsers
 *
 * @api                {GET} /v1/users Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\CoreSection\User\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('users', [Controller::class, 'getAllUsers'])
    ->name('api_user_get_all_users')
    ->middleware(['auth:api']);


<?php

/**
 * @apiGroup           User
 * @apiName            createUser
 *
 * @api                {POST} /v1/users Endpoint title here..
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

Route::post('users', [Controller::class, 'createUser'])
    ->name('api_user_create_user')
    ->middleware(['auth:api']);


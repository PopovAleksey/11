<?php

/**
 * @apiGroup           User
 * @apiName            updateUser
 *
 * @api                {PATCH} /v1/users/:id Endpoint title here..
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

Route::patch('users/{id}', [Controller::class, 'updateUser'])
    ->name('api_user_update_user')
    ->middleware(['auth:api']);


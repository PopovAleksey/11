<?php

/**
 * @apiGroup           Authentication
 * @apiName            createAuthentication
 *
 * @api                {POST} /v1/auth Endpoint title here..
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

use App\Containers\CoreSection\Authentication\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('auth', [Controller::class, 'createAuthentication'])
    ->name('api_authentication_create_authentication')
    ->middleware(['auth:api']);


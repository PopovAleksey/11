<?php

/**
 * @apiGroup           Authentication
 * @apiName            updateAuthentication
 *
 * @api                {PATCH} /v1/auth/:id Endpoint title here..
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

Route::patch('auth/{id}', [Controller::class, 'updateAuthentication'])
    ->name('api_authentication_update_authentication')
    ->middleware(['auth:api']);


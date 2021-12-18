<?php

/**
 * @apiGroup           Authentication
 * @apiName            findAuthenticationById
 *
 * @api                {GET} /v1/auth/:id Endpoint title here..
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

Route::get('auth/{id}', [Controller::class, 'findAuthenticationById'])
    ->name('api_authentication_find_authentication_by_id')
    ->middleware(['auth:api']);


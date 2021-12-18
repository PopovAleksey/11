<?php

/**
 * @apiGroup           Authentication
 * @apiName            deleteAuthentication
 *
 * @api                {DELETE} /v1/auth/:id Endpoint title here..
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

Route::delete('auth/{id}', [Controller::class, 'deleteAuthentication'])
    ->name('api_authentication_delete_authentication')
    ->middleware(['auth:api']);


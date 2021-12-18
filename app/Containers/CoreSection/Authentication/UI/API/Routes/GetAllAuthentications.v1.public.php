<?php

/**
 * @apiGroup           Authentication
 * @apiName            getAllAuthentications
 *
 * @api                {GET} /v1/auth Endpoint title here..
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

Route::get('auth', [Controller::class, 'getAllAuthentications'])
    ->name('api_authentication_get_all_authentications')
    ->middleware(['auth:api']);


<?php

/**
 * @apiGroup           Site
 * @apiName            getAllSites
 *
 * @api                {GET} /v1/sites Endpoint title here..
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

use App\Containers\ConstructorSection\Site\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('sites', [Controller::class, 'getAllSites'])
    ->name('api_site_get_all_sites')
    ->middleware(['auth:api']);


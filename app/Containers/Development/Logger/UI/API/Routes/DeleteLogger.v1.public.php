<?php

/**
 * @apiGroup           Logger
 * @apiName            deleteLogger
 *
 * @api                {DELETE} /v1/loggers/:id Endpoint title here..
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

use App\Containers\Development\Logger\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('loggers/{id}', [Controller::class, 'deleteLogger'])
    ->name('api_logger_delete_logger')
    ->middleware(['auth:api']);


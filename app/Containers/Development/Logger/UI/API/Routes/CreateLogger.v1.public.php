<?php

/**
 * @apiGroup           Logger
 * @apiName            createLogger
 *
 * @api                {POST} /v1/loggers Endpoint title here..
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

Route::post('loggers', [Controller::class, 'createLogger'])
    ->name('api_logger_create_logger')
    ->middleware(['auth:api']);


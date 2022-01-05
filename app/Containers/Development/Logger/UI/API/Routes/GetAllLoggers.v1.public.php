<?php

/**
 * @apiGroup           Logger
 * @apiName            getAllLoggers
 *
 * @api                {GET} /v1/loggers Endpoint title here..
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

Route::get('loggers', [Controller::class, 'getAllLoggers'])
    ->name('api_logger_get_all_loggers')
    ->middleware(['auth:api']);


<?php

namespace App\Containers\Development\Logger\UI\API\Controllers;

use App\Containers\Development\Logger\UI\API\Requests\CreateLoggerRequest;
use App\Containers\Development\Logger\UI\API\Requests\DeleteLoggerRequest;
use App\Containers\Development\Logger\UI\API\Requests\GetAllLoggersRequest;
use App\Containers\Development\Logger\UI\API\Requests\FindLoggerByIdRequest;
use App\Containers\Development\Logger\UI\API\Requests\UpdateLoggerRequest;
use App\Containers\Development\Logger\UI\API\Transformers\LoggerTransformer;
use App\Containers\Development\Logger\Actions\LoggerAction;
use App\Containers\Development\Logger\Actions\FindLoggerByIdAction;
use App\Containers\Development\Logger\Actions\GetAllLoggersAction;
use App\Containers\Development\Logger\Actions\UpdateLoggerAction;
use App\Containers\Development\Logger\Actions\DeleteLoggerAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function createLogger(CreateLoggerRequest $request): JsonResponse
    {
        $logger = app(LoggerAction::class)->run($request);
        return $this->created($this->transform($logger, LoggerTransformer::class));
    }

    public function findLoggerById(FindLoggerByIdRequest $request): array
    {
        $logger = app(FindLoggerByIdAction::class)->run($request);
        return $this->transform($logger, LoggerTransformer::class);
    }

    public function getAllLoggers(GetAllLoggersRequest $request): array
    {
        $loggers = app(GetAllLoggersAction::class)->run($request);
        return $this->transform($loggers, LoggerTransformer::class);
    }

    public function updateLogger(UpdateLoggerRequest $request): array
    {
        $logger = app(UpdateLoggerAction::class)->run($request);
        return $this->transform($logger, LoggerTransformer::class);
    }

    public function deleteLogger(DeleteLoggerRequest $request): JsonResponse
    {
        app(DeleteLoggerAction::class)->run($request);
        return $this->noContent();
    }
}

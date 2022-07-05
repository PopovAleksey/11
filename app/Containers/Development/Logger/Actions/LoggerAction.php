<?php

namespace App\Containers\Development\Logger\Actions;

use App\Containers\Development\Logger\Tasks\SQLLoggerTaskInterface;
use App\Ship\Parents\Actions\Action;

class LoggerAction extends Action implements LoggerActionInterface
{
    public function __construct(
        private readonly SQLLoggerTaskInterface $SQLLoggerTask
    )
    {
    }

    public function run(): void
    {
        $this->SQLLoggerTask->run();
    }
}

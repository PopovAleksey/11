<?php

namespace App\Containers\Development\Logger\Tasks;

use App\Containers\Development\Logger\Data\Dto\LoggerDto;
use App\Containers\Development\Logger\Data\Repositories\LoggerRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;

class SQLLoggerTask extends Task implements SQLLoggerTaskInterface
{
    private string $uniqHash;

    public function __construct(private readonly LoggerRepositoryInterface $repository)
    {
        $this->uniqHash = uniqid('', true);
    }

    public function run(): void
    {
        if (
            !config('app.debug') ||
            app()->environment('production')
        ) {
            return;
        }

        DB::listen(function (QueryExecuted $query) {
            if ($this->isInsertToLoggerTable($query->sql)) {
                return;
            }

            $request = request()?->method() . ': ' . request()?->path();

            $logger = (new LoggerDto())
                ->setRequest($request)
                ->setType('sql')
                ->setQuery($query->sql)
                ->setBindings($query->bindings)
                ->setTime($query->time);

            try {
                $this->repository->create([
                    'hash'     => $this->uniqHash,
                    'request'  => $logger->getRequest(),
                    'type'     => $logger->getType(),
                    'query'    => $logger->getQuery(),
                    'bindings' => $logger->getBindings(),
                    'time'     => $logger->getMilliseconds(),
                ]);
            } catch (Exception $e) {
                app('sentry')->captureException($e);
            }
        });
    }

    protected function isInsertToLoggerTable(string $queryString): bool
    {
        preg_match("/^insert into `(\w+)`.+/", $queryString, $foundLoggerQuery);
        $foundLoggerQuery = strtolower((string) data_get($foundLoggerQuery, 1));

        return $foundLoggerQuery === 'loggers';
    }
}

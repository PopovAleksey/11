<?php

namespace App\Containers\Development\Logger\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class LoggerRepository extends Repository implements LoggerRepositoryInterface
{
    protected $fieldSearchable = [
        'hash'       => '=',
        'request'    => '=',
        'type'       => '=',
        'query'      => 'like',
        'bindings'   => 'like',
        'time'       => '=',
        'created_at' => 'like',
        'updated_at' => 'like',
    ];

    public function model(): string
    {
        return config('development-logger.models.logger');
    }
}

<?php

namespace App\Containers\Development\Logger\Models;

use App\Ship\Parents\Models\Model;
use DB;

class Logger extends Model implements LoggerInterface
{
    protected $connection = 'mysql_logger';

    protected $table = 'loggers';

    protected $fillable = [
        'hash',
        'request',
        'type',
        'query',
        'bindings',
        'time',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'id'       => 'integer',
        'hash'     => 'string',
        'request'  => 'string',
        'type'     => 'string',
        'query'    => 'string',
        'bindings' => 'string',
        'time'     => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Logger';
}

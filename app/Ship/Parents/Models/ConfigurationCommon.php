<?php

namespace App\Ship\Parents\Models;

class ConfigurationCommon extends Model implements ConfigurationCommonInterface
{
    protected $fillable = [
        'config',
        'value',
    ];

    protected $casts = [
        'config' => 'string',
        'value'  => 'string',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'ConfigurationCommon';
}


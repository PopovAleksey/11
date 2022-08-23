<?php

namespace App\Ship\Parents\Models;

class ConfigurationCommon extends Model implements ConfigurationCommonInterface
{
    protected $fillable = [
        'config',
        'language_id',
        'value',
    ];

    protected $casts = [
        'config'      => 'string',
        'language_id' => 'integer',
        'value'       => 'string',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'ConfigurationCommon';
}


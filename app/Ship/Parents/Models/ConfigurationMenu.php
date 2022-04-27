<?php

namespace App\Ship\Parents\Models;

class ConfigurationMenu extends Model implements ConfigurationMenuInterface
{
    protected $fillable = [
        'content_id',
        'order',
    ];

    protected $casts = [
        'content_id' => 'integer',
        'order'      => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'ConfigurationMenu';
}


<?php

namespace App\Ship\Parents\Models;

class ConfigurationMenuItem extends Model implements ConfigurationMenuItemInterface
{
    protected $fillable = [
        'menu_id',
        'content_id',
        'order',
    ];

    protected $casts = [
        'menu_id'    => 'integer',
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
    protected string $resourceKey = 'ConfigurationMenuItem';
}


<?php

namespace App\Containers\Dashboard\Configuration\Models;

use App\Ship\Parents\Models\Model;

class Configuration extends Model implements ConfigurationInterface
{
    protected $fillable = [

    ];

    protected $casts = [

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


<?php

namespace App\Containers\Dashboard\Configuration\Models;

use App\Ship\Parents\Models\Model;

class ConfigurationMenu extends Model implements ConfigurationMenuInterface
{
    protected $fillable = [
        'content_id',
    ];

    protected $casts = [
        'content_id' => 'integer',
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


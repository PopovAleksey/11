<?php

namespace App\Containers\Dashboard\Content\Models;

use App\Ship\Parents\Models\Model;

class ContentValue extends Model implements ContentValueInterface
{
    protected $fillable = [

    ];

    protected $attributes = [

    ];

    protected $hidden = [

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
    protected string $resourceKey = 'ContentValueModel';
}


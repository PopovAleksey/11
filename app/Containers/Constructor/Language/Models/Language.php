<?php

namespace App\Containers\Constructor\Language\Models;

use App\Ship\Parents\Models\Model;

class Language extends Model implements LanguageInterface
{
    protected $fillable = [
        'name',
        'short_name',
        'active'
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'short_name' => 'string',
        'active'     => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Language';
}

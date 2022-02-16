<?php

namespace App\Containers\Constructor\Seo\Models;

use App\Ship\Parents\Models\Model;

class Seo extends Model implements SeoInterface
{
    protected $table = 'seo_links';

    protected $fillable = [
        'page_id',
        'page_field_id',
        'language_id',
        'link',
        'case_type',
        'static',
        'active',
    ];

    protected $casts = [
        'page_id'       => 'integer',
        'page_field_id' => 'integer',
        'language_id'   => 'integer',
        'link'          => 'string',
        'case_type'     => 'string',
        'static'        => 'boolean',
        'active'        => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'SeoLinks';
}


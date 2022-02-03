<?php

namespace App\Containers\Constructor\Page\Models;

use App\Ship\Parents\Models\Model;

class PageField extends Model implements PageFieldInterface
{
    protected $fillable = [
        'page_id',
        'name',
        'type',
        'placeholder',
        'mask',
        'values',
        'active',
    ];

    protected $casts = [
        'page_id'     => 'integer',
        'name'        => 'string',
        'type'        => 'string',
        'placeholder' => 'string',
        'mask'        => 'string',
        'values'       => 'array',
        'active'      => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'PageField';

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Containers\Constructor\Page\Models\PageInterface
     */
    public function getPageAttribute(): \Illuminate\Database\Eloquent\Model|PageInterface
    {
        return $this->hasOne(Page::class, 'id', 'page_id')->first();
    }
}


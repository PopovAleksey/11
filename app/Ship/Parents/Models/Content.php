<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Collection;

class Content extends Model implements ContentInterface
{
    protected $fillable = [
        'page_id',
        'parent_content_id',
        'active',
    ];

    protected $casts = [
        'page_id'           => 'integer',
        'parent_content_id' => 'integer',
        'active'            => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Content';


    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getValuesAttribute(): Collection
    {
        return $this->hasMany(ContentValue::class, 'content_id')->orderBy('created_at')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\PageInterface
     */
    public function getPageAttribute(): \Illuminate\Database\Eloquent\Model|PageInterface
    {
        return $this->hasOne(Page::class, 'id', 'page_id')->first();
    }
}


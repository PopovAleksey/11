<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Page extends Model implements PageInterface
{
    protected $fillable = [
        'name',
        'parent_page_id',
        'type',
        'active',
    ];

    protected $casts = [
        'name'           => 'string',
        'parent_page_id' => 'integer',
        'type'           => 'string',
        'active'         => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Page';

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFieldsAttribute(): Collection
    {
        return $this->hasMany(PageField::class, 'page_id')->orderBy('created_at')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasOne|\App\Ship\Parents\Models\PageInterface
     */
    public function getChildPageAttribute(): \Illuminate\Database\Eloquent\Model|HasOne|PageInterface
    {
        return $this->hasOne(__CLASS__, 'parent_page_id')->first();
    }

}


<?php

namespace App\Containers\Constructor\Page\Models;

use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Collection;

class Page extends Model implements PageInterface
{
    protected $fillable = [
        'name',
        'type',
        'active',
    ];

    protected $casts = [
        'name'   => 'string',
        'type'   => 'string',
        'active' => 'boolean',
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

}


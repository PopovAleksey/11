<?php

namespace App\Containers\Dashboard\Content\Models;

use App\Containers\Constructor\Page\Models\Page;
use App\Containers\Constructor\Page\Models\PageInterface;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Collection;

class Content extends Model implements ContentInterface
{
    protected $fillable = [
        'page_id',
        'active',
    ];

    protected $casts = [
        'page_id' => 'integer',
        'active'  => 'boolean',
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
     * @return \Illuminate\Database\Eloquent\Model|\App\Containers\Constructor\Page\Models\PageInterface
     */
    public function getPageAttribute(): \Illuminate\Database\Eloquent\Model|PageInterface
    {
        return $this->hasOne(Page::class, 'page_id')->first();
    }
}


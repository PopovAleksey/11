<?php

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Collection;

class Seo extends Model implements SeoInterface
{
    protected $table = 'seo';

    protected $fillable = [
        'page_id',
        'page_field_id',
        'language_id',
        'case_type',
        'static',
        'active',
    ];

    protected $casts = [
        'page_id'       => 'integer',
        'page_field_id' => 'integer',
        'language_id'   => 'integer',
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
    protected string $resourceKey = 'Seo';

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\PageInterface
     */
    public function getPageAttribute(): \Illuminate\Database\Eloquent\Model|PageInterface
    {
        return $this->hasOne(Page::class, 'id', 'page_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\PageFieldInterface
     */
    public function getPageFieldAttribute(): \Illuminate\Database\Eloquent\Model|PageFieldInterface
    {
        return $this->hasOne(PageField::class, 'id', 'page_field_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\LanguageInterface
     */
    public function getLanguageAttribute(): \Illuminate\Database\Eloquent\Model|LanguageInterface
    {
        return $this->hasOne(Language::class, 'id', 'language_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLinksAttribute(): Collection
    {
        return $this->hasMany(SeoLink::class, 'seo_id')->orderBy('created_at')->get();
    }
}


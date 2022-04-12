<?php

namespace App\Containers\Dashboard\Content\Models;

use App\Containers\Constructor\Language\Models\Language;
use App\Containers\Constructor\Language\Models\LanguageInterface;
use App\Containers\Constructor\Page\Models\PageField;
use App\Containers\Constructor\Page\Models\PageFieldInterface;
use App\Ship\Parents\Models\Model;

class ContentValue extends Model implements ContentValueInterface
{
    protected $fillable = [
        'language_id',
        'content_id',
        'page_field_id',
        'value',
    ];

    protected $casts = [
        'language_id'   => 'integer',
        'content_id'    => 'integer',
        'page_field_id' => 'integer',
        'value'         => 'string',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'ContentValueModel';

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Containers\Constructor\Language\Models\LanguageInterface
     */
    public function getLanguageAttribute(): \Illuminate\Database\Eloquent\Model|LanguageInterface
    {
        return $this->hasOne(Language::class, 'id', 'language_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Containers\Dashboard\Content\Models\ContentInterface
     */
    public function getContentAttribute(): \Illuminate\Database\Eloquent\Model|ContentInterface
    {
        return $this->hasOne(Content::class, 'id', 'content_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Containers\Constructor\Page\Models\PageFieldInterface
     */
    public function getPageFieldAttribute(): \Illuminate\Database\Eloquent\Model|PageFieldInterface
    {
        return $this->hasOne(PageField::class, 'id', 'page_field_id')->first();
    }
}


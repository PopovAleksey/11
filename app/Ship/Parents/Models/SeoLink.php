<?php

namespace App\Ship\Parents\Models;

class SeoLink extends Model implements SeoLinkInterface
{
    protected $fillable = [
        'seo_id',
        'content_id',
        'link',
    ];

    protected $casts = [
        'seo_id'     => 'integer',
        'content_id' => 'integer',
        'link'       => 'string',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'SeoLinks';


    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\SeoInterface
     */
    public function getSeoAttribute(): \Illuminate\Database\Eloquent\Model|SeoInterface
    {
        return $this->hasOne(Seo::class, 'id', 'seo_id')->first();
    }
}


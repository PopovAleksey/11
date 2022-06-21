<?php

namespace App\Ship\Parents\Models;

class Localization extends Model implements LocalizationInterface
{
    protected $fillable = [
        'point',
        'theme_id',
    ];

    protected $casts = [
        'point'       => 'string',
        'theme_id'    => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Localization';


    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\ThemeInterface
     */
    public function getThemeAttribute(): \Illuminate\Database\Eloquent\Model|ThemeInterface
    {
        return $this->hasOne(Theme::class, 'id', 'theme_id')->first();
    }
}
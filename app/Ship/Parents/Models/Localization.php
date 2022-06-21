<?php

namespace App\Ship\Parents\Models;

class Localization extends Model implements LocalizationInterface
{
    protected $fillable = [
        'point',
        'language_id',
        'theme_id',
        'value',
    ];

    protected $casts = [
        'point'       => 'string',
        'language_id' => 'integer',
        'theme_id'    => 'integer',
        'value'       => 'string',
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
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\LanguageInterface
     */
    public function getLanguageAttribute(): \Illuminate\Database\Eloquent\Model|LanguageInterface
    {
        return $this->hasOne(Language::class, 'id', 'language_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\ThemeInterface
     */
    public function getThemeAttribute(): \Illuminate\Database\Eloquent\Model|ThemeInterface
    {
        return $this->hasOne(Theme::class, 'id', 'theme_id')->first();
    }
}
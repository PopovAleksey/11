<?php

namespace App\Ship\Parents\Models;

class LocalizationValues extends Model implements LocalizationValuesInterface
{
    protected $fillable = [
        'localization_id',
        'language_id',
        'value',
    ];

    protected $casts = [
        'localization_id' => 'integer',
        'language_id'     => 'integer',
        'value'           => 'string',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'LocalizationValuesModel';

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\ThemeInterface
     */
    public function getLocalizationAttribute(): \Illuminate\Database\Eloquent\Model|ThemeInterface
    {
        return $this->hasOne(Localization::class, 'id', 'localization_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\LanguageInterface
     */
    public function getLanguageAttribute(): \Illuminate\Database\Eloquent\Model|LanguageInterface
    {
        return $this->hasOne(Language::class, 'id', 'language_id')->first();
    }
}


<?php

namespace App\Ship\Parents\Models;

class Template extends Model implements TemplateInterface
{
    protected $fillable = [
        'type',
        'theme_id',
        'page_id',
        'language_id',
        'html',
    ];

    protected $casts = [
        'type'        => 'string',
        'theme_id'    => 'integer',
        'page_id'     => 'integer',
        'language_id' => 'integer',
        'html'        => 'string',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Template';


    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\ThemeInterface
     */
    public function getThemeAttribute(): \Illuminate\Database\Eloquent\Model|ThemeInterface
    {
        return $this->hasOne(Theme::class, 'id', 'theme_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\PageInterface|null
     */
    public function getPageAttribute(): \Illuminate\Database\Eloquent\Model|PageInterface|null
    {
        return $this->hasOne(Page::class, 'id', 'page_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\LanguageInterface|null
     */
    public function getLanguageAttribute(): \Illuminate\Database\Eloquent\Model|LanguageInterface|null
    {
        return $this->hasOne(Language::class, 'id', 'language_id')->first();
    }


}


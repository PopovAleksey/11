<?php

namespace App\Ship\Parents\Models;

class Template extends Model implements TemplateInterface
{
    protected $fillable = [
        'name',
        'type',
        'theme_id',
        'page_id',
        'child_page_id',
        'language_id',
        'html',
    ];

    protected $casts = [
        'name'                    => 'string',
        'type'                    => 'string',
        'theme_id'                => 'integer',
        'page_id'                 => 'integer',
        'child_page_id'           => 'integer',
        'language_id'             => 'integer',
        'template_filepath'       => 'string',
        'child_template_filepath' => 'string',
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
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\PageInterface|null
     */
    public function getChildPageAttribute(): \Illuminate\Database\Eloquent\Model|PageInterface|null
    {
        return $this->hasOne(Page::class, 'id', 'child_page_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Ship\Parents\Models\LanguageInterface|null
     */
    public function getLanguageAttribute(): \Illuminate\Database\Eloquent\Model|LanguageInterface|null
    {
        return $this->hasOne(Language::class, 'id', 'language_id')->first();
    }


}


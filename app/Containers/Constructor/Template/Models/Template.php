<?php

namespace App\Containers\Constructor\Template\Models;

use App\Containers\Constructor\Page\Models\Page;
use App\Containers\Constructor\Page\Models\PageInterface;
use App\Ship\Parents\Models\Model;

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
     * @return \Illuminate\Database\Eloquent\Model|\App\Containers\Constructor\Template\Models\ThemeInterface
     */
    public function getThemeAttribute(): \Illuminate\Database\Eloquent\Model|ThemeInterface
    {
        return $this->hasOne(Theme::class, 'id', 'theme_id')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\App\Containers\Constructor\Page\Models\PageInterface
     */
    public function getPageAttribute(): \Illuminate\Database\Eloquent\Model|PageInterface
    {
        return $this->hasOne(Page::class, 'id', 'page_id')->first();
    }


}


<?php

namespace App\Containers\Constructor\Template\Models;

use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Collection;

class Theme extends Model implements ThemeInterface
{
    protected $fillable = [
        'name',
        'active',
    ];

    protected $casts = [
        'id'     => 'integer',
        'name'   => 'string',
        'active' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Theme';


    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTemplatesAttribute(): Collection
    {
        return $this->hasMany(Template::class, 'theme_id')->orderBy('created_at')->get();
    }
}


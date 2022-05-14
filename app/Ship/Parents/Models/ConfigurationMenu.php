<?php

namespace App\Ship\Parents\Models;


use Illuminate\Database\Eloquent\Collection;

class ConfigurationMenu extends Model implements ConfigurationMenuInterface
{
    protected $fillable = [
        'name',
        'active',
        'template_id',
    ];

    protected $casts = [
        'name'        => 'string',
        'active'      => 'boolean',
        'template_id' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'ConfigurationMenu';

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItemsAttribute(): Collection
    {
        return $this->hasMany(ConfigurationMenuItem::class, 'menu_id')->orderBy('order')->get();
    }
}


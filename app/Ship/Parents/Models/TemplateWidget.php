<?php

namespace App\Ship\Parents\Models;

class TemplateWidget extends Model implements TemplateWidgetInterface
{
    protected $fillable = [
        'template_id',
        'count_elements',
        'show_by',
    ];

    protected $casts = [
        'template_id'    => 'integer',
        'count_elements' => 'integer',
        'show_by'        => 'string',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'TemplateWidget';
}


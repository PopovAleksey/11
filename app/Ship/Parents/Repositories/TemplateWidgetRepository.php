<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\TemplateWidgetInterface;

class TemplateWidgetRepository extends Repository implements TemplateWidgetRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'             => '=',
        'template_id'    => '=',
        'count_elements' => '=',
        'show_by'        => '=',
    ];

    public function model(): string
    {
        return TemplateWidgetInterface::class;
    }
}

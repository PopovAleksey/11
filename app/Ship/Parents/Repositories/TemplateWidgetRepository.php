<?php

namespace App\Ship\Parents\Repositories;

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
}

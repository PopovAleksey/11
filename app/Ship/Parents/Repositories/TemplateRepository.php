<?php

namespace App\Ship\Parents\Repositories;

use App\Containers\Constructor\Template\Models\Template;

class TemplateRepository extends Repository implements TemplateRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'          => '=',
        'type'        => '=',
        'theme_id'    => '=',
        'page_id'     => '=',
        'language_id' => '=',
        'html'        => 'like',
    ];

    public function model(): string
    {
        return Template::class;
    }
}

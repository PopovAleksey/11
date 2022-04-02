<?php

namespace App\Containers\Constructor\Template\Data\Repositories;

use App\Containers\Constructor\Template\Models\Template;
use App\Ship\Parents\Repositories\Repository;

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
<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\SeoInterface;

class SeoRepository extends Repository implements SeoRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'            => '=',
        'page_id'       => '=',
        'page_field_id' => '=',
        'language_id'   => '=',
        'link'          => 'like',
        'case_type'     => '=',
        'static'        => '=',
        'active'        => '=',
    ];

    public function model(): string
    {
        return SeoInterface::class;
    }
}

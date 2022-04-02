<?php

namespace App\Containers\Dashboard\Content\Data\Repositories;

use App\Containers\Dashboard\Content\Models\ContentValue;
use App\Ship\Parents\Repositories\Repository;

class ContentValueRepository extends Repository implements ContentValueRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'            => '=',
        'content_id'    => '=',
        'page_field_id' => '=',
        'value'         => 'like',
    ];

    public function model(): string
    {
        return ContentValue::class;
    }
}

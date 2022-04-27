<?php

namespace App\Ship\Parents\Repositories;

use App\Containers\Dashboard\Content\Models\Content;

class ContentRepository extends Repository implements ContentRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'      => '=',
        'page_id' => '=',
        'active'  => '=',
    ];

    public function model(): string
    {
        return Content::class;
    }
}

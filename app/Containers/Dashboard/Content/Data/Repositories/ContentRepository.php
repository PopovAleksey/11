<?php

namespace App\Containers\Dashboard\Content\Data\Repositories;

use App\Containers\Dashboard\Content\Models\Content;
use App\Ship\Parents\Repositories\Repository;

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

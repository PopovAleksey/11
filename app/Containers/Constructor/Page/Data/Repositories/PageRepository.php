<?php

namespace App\Containers\Constructor\Page\Data\Repositories;

use App\Containers\Constructor\Page\Models\Page;
use App\Ship\Parents\Repositories\Repository;

class PageRepository extends Repository implements PageRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'             => '=',
        'name'           => 'like',
        'parent_page_id' => '=',
        'action'         => '=',
    ];

    public function model(): string
    {
        return Page::class;
    }
}

<?php

namespace App\Ship\Parents\Repositories;

use App\Containers\Constructor\Page\Models\Page;

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

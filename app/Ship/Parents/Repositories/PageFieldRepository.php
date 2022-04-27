<?php

namespace App\Ship\Parents\Repositories;

use App\Containers\Constructor\Page\Models\PageField;

class PageFieldRepository extends Repository implements PageFieldRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'          => '=',
        'name'        => 'like',
        'type'        => '=',
        'placeholder' => '=',
        'mask'        => 'like',
        'values'      => 'like',
        'action'      => '=',
    ];

    public function model(): string
    {
        return PageField::class;
    }
}

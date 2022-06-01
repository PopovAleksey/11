<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\PageFieldInterface;

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
        return PageFieldInterface::class;
    }
}

<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ThemeInterface;

class ThemeRepository extends Repository implements ThemeRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'        => '=',
        'name'      => 'like',
        'directory' => 'like',
        'active'    => '=',
    ];

    public function model(): string
    {
        return ThemeInterface::class;
    }
}

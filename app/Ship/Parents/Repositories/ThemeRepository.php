<?php

namespace App\Ship\Parents\Repositories;

use App\Containers\Constructor\Template\Models\Theme;

class ThemeRepository extends Repository implements ThemeRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'     => '=',
        'name'   => 'like',
        'active' => '=',
    ];

    public function model(): string
    {
        return Theme::class;
    }
}

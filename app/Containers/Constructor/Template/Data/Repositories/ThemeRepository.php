<?php

namespace App\Containers\Constructor\Template\Data\Repositories;

use App\Containers\Constructor\Template\Models\Theme;
use App\Ship\Parents\Repositories\Repository;

class ThemeRepository extends Repository implements ThemeRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

    public function model(): string
    {
        return Theme::class;
    }
}

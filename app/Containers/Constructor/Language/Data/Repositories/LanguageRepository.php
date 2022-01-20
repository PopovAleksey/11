<?php

namespace App\Containers\Constructor\Language\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class LanguageRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}

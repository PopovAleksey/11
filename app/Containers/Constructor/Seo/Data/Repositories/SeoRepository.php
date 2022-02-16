<?php

namespace App\Containers\Constructor\Seo\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class SeoRepository extends Repository implements SeoRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}

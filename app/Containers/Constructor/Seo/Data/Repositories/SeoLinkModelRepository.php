<?php

namespace App\Containers\Constructor\Seo\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class SeoLinkModelRepository extends Repository implements SeoLinkModelRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}

<?php

namespace App\Containers\Dashboard\Content\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class ContentRepository extends Repository implements ContentRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}

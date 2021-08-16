<?php

namespace App\Containers\ConstructorSection\Site\Data\Repositories;

use App\Containers\ConstructorSection\Site\Interfaces\Repositories\SiteRepositoryInterface;
use App\Ship\Parents\Repositories\Repository;

class SiteRepository extends Repository implements SiteRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

    public function getAll()
    {

    }
}

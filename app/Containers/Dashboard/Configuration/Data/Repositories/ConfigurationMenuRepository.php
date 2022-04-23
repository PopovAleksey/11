<?php

namespace App\Containers\Dashboard\Configuration\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class ConfigurationMenuRepository extends Repository implements ConfigurationMenuRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}

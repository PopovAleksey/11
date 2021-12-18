<?php

namespace App\Containers\CoreSection\Authentication\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class AuthenticationRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}

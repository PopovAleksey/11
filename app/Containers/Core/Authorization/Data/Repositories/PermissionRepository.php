<?php

namespace App\Containers\Core\Authorization\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class PermissionRepository extends Repository
{
    protected $fieldSearchable = [
        'name' => '=',
        'display_name' => 'like',
        'description' => 'like',
    ];

    public function model(): string
    {
        return config('permission.models.permission');
    }
}

<?php

namespace App\Containers\Core\Authorization\Tasks;

use App\Containers\Core\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Core\Authorization\Models\Role;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Str;

class FindRoleTask extends Task
{
    protected RoleRepository $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($roleNameOrId): Role
    {
        $query = (is_numeric($roleNameOrId) || Str::isUuid($roleNameOrId)) ? ['id' => $roleNameOrId] : ['name' => $roleNameOrId];

        return $this->repository->findWhere($query)->first();
    }
}

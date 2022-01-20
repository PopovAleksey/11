<?php

namespace App\Containers\Core\Authorization\Tasks;

use App\Containers\Core\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\Core\Authorization\Models\Permission;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Str;

class FindPermissionTask extends Task
{
    protected PermissionRepository $repository;

    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($permissionNameOrId): Permission
    {
        $query = (is_numeric($permissionNameOrId) || Str::isUuid($permissionNameOrId)) ? ['id' => $permissionNameOrId] : ['name' => $permissionNameOrId];

        return $this->repository->findWhere($query)->first();
    }
}

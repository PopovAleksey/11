<?php

namespace App\Containers\Core\Authorization\UI\API\Controllers;

use App\Containers\Core\Authorization\Actions\AssignUserToRoleAction;
use App\Containers\Core\Authorization\Actions\AttachPermissionsToRoleAction;
use App\Containers\Core\Authorization\Actions\CreateRoleAction;
use App\Containers\Core\Authorization\Actions\DeleteRoleAction;
use App\Containers\Core\Authorization\Actions\DetachPermissionsFromRoleAction;
use App\Containers\Core\Authorization\Actions\FindPermissionAction;
use App\Containers\Core\Authorization\Actions\FindRoleAction;
use App\Containers\Core\Authorization\Actions\GetAllPermissionsAction;
use App\Containers\Core\Authorization\Actions\GetAllRolesAction;
use App\Containers\Core\Authorization\Actions\RevokeUserFromRoleAction;
use App\Containers\Core\Authorization\Actions\SyncPermissionsOnRoleAction;
use App\Containers\Core\Authorization\Actions\SyncUserRolesAction;
use App\Containers\Core\Authorization\UI\API\Requests\AssignUserToRoleRequest;
use App\Containers\Core\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;
use App\Containers\Core\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Containers\Core\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Containers\Core\Authorization\UI\API\Requests\DetachPermissionToRoleRequest;
use App\Containers\Core\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Containers\Core\Authorization\UI\API\Requests\FindRoleRequest;
use App\Containers\Core\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Containers\Core\Authorization\UI\API\Requests\GetAllRolesRequest;
use App\Containers\Core\Authorization\UI\API\Requests\RevokeUserFromRoleRequest;
use App\Containers\Core\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Containers\Core\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\Core\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Containers\Core\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\Core\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function getAllPermissions(GetAllPermissionsRequest $request): array
    {
        $permissions = app(GetAllPermissionsAction::class)->run();
        return $this->transform($permissions, PermissionTransformer::class);
    }

    public function findPermission(FindPermissionRequest $request): array
    {
        $permission = app(FindPermissionAction::class)->run($request);
        return $this->transform($permission, PermissionTransformer::class);
    }

    public function getAllRoles(GetAllRolesRequest $request): array
    {
        $roles = app(GetAllRolesAction::class)->run();
        return $this->transform($roles, RoleTransformer::class);
    }

    public function findRole(FindRoleRequest $request): array
    {
        $role = app(FindRoleAction::class)->run($request);
        return $this->transform($role, RoleTransformer::class);
    }

    public function assignUserToRole(AssignUserToRoleRequest $request): array
    {
        $user = app(AssignUserToRoleAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function syncUserRoles(SyncUserRolesRequest $request): array
    {
        $user = app(SyncUserRolesAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function deleteRole(DeleteRoleRequest $request): JsonResponse
    {
        app(DeleteRoleAction::class)->run($request);
        return $this->noContent();
    }

    public function revokeRoleFromUser(RevokeUserFromRoleRequest $request): array
    {
        $user = app(RevokeUserFromRoleAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function attachPermissionToRole(AttachPermissionToRoleRequest $request): array
    {
        $role = app(AttachPermissionsToRoleAction::class)->run($request);
        return $this->transform($role, RoleTransformer::class);
    }

    public function syncPermissionOnRole(SyncPermissionsOnRoleRequest $request): array
    {
        $role = app(SyncPermissionsOnRoleAction::class)->run($request);
        return $this->transform($role, RoleTransformer::class);
    }

    public function detachPermissionFromRole(DetachPermissionToRoleRequest $request): array
    {
        $role = app(DetachPermissionsFromRoleAction::class)->run($request);
        return $this->transform($role, RoleTransformer::class);
    }

    public function createRole(CreateRoleRequest $request): array
    {
        $role = app(CreateRoleAction::class)->run($request);
        return $this->transform($role, RoleTransformer::class);
    }
}

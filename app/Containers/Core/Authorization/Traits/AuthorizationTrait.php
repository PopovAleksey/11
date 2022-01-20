<?php

namespace App\Containers\Core\Authorization\Traits;

use App\Containers\Core\Authentication\Tasks\GetAuthenticatedUserTask;
use Illuminate\Contracts\Auth\Authenticatable;

trait AuthorizationTrait
{
    public function getUser(): ?Authenticatable
    {
        return app(GetAuthenticatedUserTask::class)->run();
    }

    public function hasAdminRole(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Return the "highest" role of a user (0 if the user does not have any role)
     */
    public function getRoleLevel(): int
    {
        return ($role = $this->roles()->orderBy('level', 'DESC')->first()) ? $role->level : 0;
    }
}

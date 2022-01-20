<?php

namespace App\Containers\Core\User\Traits;

use App\Containers\Core\Authentication\Tasks\GetAuthenticatedUserTask;

trait IsOwnerTrait
{
    /**
     * Check if the submitted ID (mainly URL ID's) is the same as
     * the authenticated user ID (based on the user Token).
     */
    public function isOwner(): bool
    {
        $user = app(GetAuthenticatedUserTask::class)->run();
        return $user->id === $this->id;
    }
}

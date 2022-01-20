<?php

namespace App\Containers\Core\Authentication\Tasks;

use App\Containers\Core\User\Data\Dto\UserDto;
use App\Ship\Parents\Tasks\Task;

class CheckIfUserEmailIsConfirmedTask extends Task implements CheckIfUserEmailIsConfirmedTaskInterface
{
    public function run(UserDto $user): bool
    {
        if ($this->emailConfirmationIsRequired()) {
            return !is_null($user->getEmailVerifiedAt());
        }

        return true;
    }

    private function emailConfirmationIsRequired()
    {
        return config('appSection-authentication.require_email_confirmation');
    }
}

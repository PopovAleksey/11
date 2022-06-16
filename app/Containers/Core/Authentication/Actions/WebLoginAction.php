<?php

namespace App\Containers\Core\Authentication\Actions;

use App\Containers\Core\Authentication\Data\Dto\LoginDto;
use App\Containers\Core\Authentication\Exceptions\LoginFailedException;
use App\Containers\Core\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\Core\Authentication\Tasks\CheckIfUserEmailIsConfirmedTaskInterface;
use App\Containers\Core\Authentication\Tasks\LoginTaskInterface;
use App\Containers\Core\User\Auth;
use App\Containers\Core\User\Data\Dto\UserDto;
use App\Ship\Parents\Actions\Action;

class WebLoginAction extends Action implements WebLoginActionInterface
{
    public function __construct(
        private LoginTaskInterface                       $loginTask,
        private CheckIfUserEmailIsConfirmedTaskInterface $checkIfUserEmailIsConfirmedTask
    )
    {
    }

    /**
     * @param \App\Containers\Core\Authentication\Data\Dto\LoginDto $loginDto
     * @return \App\Containers\Core\User\Data\Dto\UserDto
     * @throws \App\Containers\Core\Authentication\Exceptions\LoginFailedException
     * @throws \App\Containers\Core\Authentication\Exceptions\UserNotConfirmedException
     */
    public function run(LoginDto $loginDto): UserDto
    {
        $isSuccessful = $this->loginTask->run($loginDto);

        if (!$isSuccessful) {
            throw new LoginFailedException();
        }

        $user = Auth::user();

        $isUserConfirmed = $this->checkIfUserEmailIsConfirmedTask->run($user);

        if (!$isUserConfirmed) {
            throw new UserNotConfirmedException();
        }

        return $user;
    }
}

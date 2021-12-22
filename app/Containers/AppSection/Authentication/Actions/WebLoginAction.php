<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Data\Dto\LoginDto;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\AppSection\Authentication\Tasks\CheckIfUserEmailIsConfirmedTaskInterface;
use App\Containers\AppSection\Authentication\Tasks\LoginTaskInterface;
use App\Containers\AppSection\User\Auth;
use App\Containers\AppSection\User\Data\Dto\UserDto;
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
     * @param \App\Containers\AppSection\Authentication\Data\Dto\LoginDto $loginDto
     * @return \App\Containers\AppSection\User\Data\Dto\UserDto
     * @throws \App\Containers\AppSection\Authentication\Exceptions\LoginFailedException
     * @throws \App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException
     */
    public function run(LoginDto $loginDto): UserDto
    {
        $isSuccessful = $this->loginTask->run($loginDto->getEmail(), $loginDto->getPassword(), $loginDto->isRememberMe());

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

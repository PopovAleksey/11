<?php

namespace App\Containers\Core\Authentication\Actions\GoogleOAuth;

use App\Containers\Core\Authentication\Exceptions\LoginFailedException;
use App\Containers\Core\Authentication\Tasks\GoogleOAuth\GetAuthCredentialsTaskInterface;
use App\Containers\Core\Authentication\Tasks\LoginTaskInterface;
use App\Containers\Core\User\Auth;
use App\Containers\Core\User\Data\Dto\UserDto;
use App\Ship\Parents\Actions\Action;

class SignInAction extends Action implements SignInActionInterface
{
    public function __construct(
        private GetAuthCredentialsTaskInterface $getAuthCredentialsTask,
        private LoginTaskInterface              $loginTask
    )
    {
    }

    /**
     * @param string $code
     * @return \App\Containers\Core\User\Data\Dto\UserDto
     * @throws \App\Containers\Core\Authentication\Exceptions\LoginFailedException
     */
    public function run(string $code): UserDto
    {
        $credentials  = $this->getAuthCredentialsTask->run($code);
        $isSuccessful = $this->loginTask->run($credentials);

        if (!$isSuccessful) {
            throw new LoginFailedException();
        }

        return Auth::user();
    }
}

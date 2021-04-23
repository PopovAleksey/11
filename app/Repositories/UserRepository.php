<?php


namespace App\Repositories;


use App\Exceptions\User\SignInException;
use App\Interfaces\Models\User;
use App\Services\User\UserServiceDTO;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends Repository implements \App\Interfaces\Repositories\UserRepository
{
    public function __construct(
        private User $userModel
    )
    {
    }

    /**
     * @param UserServiceDTO $signInDTO
     * @return User
     * @throws SignInException
     */
    public function signInByEmailAndPassword(UserServiceDTO $signInDTO): User
    {

        $user = $this->userModel
            ->where('email', $signInDTO->getEmail())
            ->where('password', $signInDTO->getPassword())
            ->first();

        if ($user === null) {
            throw new SignInException();
        }

        return $user;
    }
}
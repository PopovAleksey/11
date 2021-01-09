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
    private User $userModel;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->userModel = $user;
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
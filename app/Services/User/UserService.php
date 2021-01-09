<?php


namespace App\Services\User;


use App\Exceptions\RuntimeException;
use App\Http\Requests\User\SignInDTO;
use App\Interfaces\Models\User;
use App\Interfaces\Repositories\UserRepository;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 * @package App\Services\User
 */
class UserService extends Service implements \App\Interfaces\Services\UserService
{
    /**
     * @var UserRepository
     */
    private UserRepository $useRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->useRepository = $userRepository;
    }

    /**
     * @var User|null
     */
    private ?User $userModel = null;

    /**
     * @param SignInDTO $signInDTO
     * @return $this
     */
    public function singIn(SignInDTO $signInDTO): self
    {
        $userDTO = (new UserServiceDTO())
            ->setEmail($signInDTO->getEmail())
            ->setPassword($signInDTO->getPassword());

        $this->userModel = $this->useRepository->signInByEmailAndPassword($userDTO);

        return $this;
    }

    /**
     * @return User
     * @throws RuntimeException
     */
    public function getUser(): User
    {
        $this->userModel = $this->userModel ?? Auth::user();

        if ($this->userModel === null) {
            throw new RuntimeException('You cannot get NULL user model');
        }

        return $this->userModel;
    }

    /**
     * @return string
     * @throws RuntimeException
     */
    public function createToken(): string
    {
        return $this->getUser()->createToken('sign_in')->plainTextToken;
    }
}
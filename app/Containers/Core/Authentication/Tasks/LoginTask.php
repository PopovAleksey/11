<?php

namespace App\Containers\Core\Authentication\Tasks;

use App\Containers\Core\Authentication\Data\Dto\LoginDto;
use App\Containers\Core\Authentication\Exceptions\LoginFailedException;
use App\Containers\Core\User\Data\Repositories\UserRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginTask extends Task implements LoginTaskInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param \App\Containers\Core\Authentication\Data\Dto\LoginDto $loginDto
     * @return bool
     * @throws \App\Containers\Core\Authentication\Exceptions\LoginFailedException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function run(LoginDto $loginDto): bool
    {
        $credentials = collect(['email' => $loginDto->getEmail()])
            ->when(
                $loginDto->getPassword() !== null,
                fn(Collection $credentials) => $credentials->put('password', $loginDto->getPassword())
            );

        /**
         * @var \App\Containers\Core\User\Models\User|null $user
         */
        $user = $this->userRepository->findWhere($credentials->toArray())?->first();

        if ($user === null) {
            $usersCount = $this->userRepository->all()->count();

            if ($usersCount > 0) {
                throw new LoginFailedException();
            }

            $pool     = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $password = substr(str_shuffle(str_repeat($pool, 5)), 0, 20);
            $user     = $this->userRepository->create([
                'password' => Hash::make($password),
                'email'    => $loginDto->getEmail(),
                'name'     => $loginDto->getName(),
                'is_admin' => true,
            ]);
        }

        return Auth::loginUsingId($user->id, $loginDto->isRememberMe()) !== false;
    }
}

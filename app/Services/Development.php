<?php


namespace App\Services;


use App\Exceptions\RuntimeException;
use App\Interfaces\Models\User;
use App\Interfaces\Services\DevelopmentService;

/**
 * Class Development
 * @package App\Services
 */
class Development extends Service implements DevelopmentService
{
    /**
     * @var User
     */
    private User $userModel;

    /**
     * Development constructor.
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @return User
     * @throws RuntimeException
     */
    public function getRandomEmail(): string
    {
        $users  = $this->userModel->get()->keyBy('id');
        $randID = array_rand($users->toArray());
        $user   = $users->get($randID);

        if ($user === null) {
            throw new RuntimeException('User not found!');
        }

        return data_get($user, 'email');
    }
}
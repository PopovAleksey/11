<?php


namespace App\Interfaces\Repositories;


use App\Interfaces\Models\User;
use App\Services\User\UserServiceDTO;

interface UserRepository
{
    public function signInByEmailAndPassword(UserServiceDTO $signInDTO): User;

}
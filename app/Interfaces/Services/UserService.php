<?php


namespace App\Interfaces\Services;


use App\Http\Requests\User\SignInDTO;
use App\Interfaces\Models\User;

interface UserService
{
    public function singIn(SignInDTO $signInDTO): self;

    public function getUser(): User;

    public function createToken(): string;
}

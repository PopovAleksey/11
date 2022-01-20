<?php

namespace App\Containers\Core\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;

class LoginTask extends Task implements LoginTaskInterface
{
    public function run(string $email, string $password, bool $remember = false): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password], $remember);
    }
}

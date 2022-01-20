<?php

namespace App\Containers\Core\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class GetAuthenticatedUserTask extends Task
{
    public function run(): ?Authenticatable
    {
        return Auth::user();
    }
}

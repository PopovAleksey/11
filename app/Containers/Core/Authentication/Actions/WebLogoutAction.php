<?php

namespace App\Containers\Core\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Auth;

class WebLogoutAction extends Action implements WebLogoutActionInterface
{
    public function run(): void
    {
        Auth::logout();
    }
}

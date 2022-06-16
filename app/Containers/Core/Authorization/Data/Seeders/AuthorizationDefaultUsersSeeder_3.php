<?php

namespace App\Containers\Core\Authorization\Data\Seeders;

use App\Containers\Core\Authorization\Tasks\FindRoleTask;
use App\Containers\Core\User\Tasks\CreateUserByCredentialsTask;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationDefaultUsersSeeder_3 extends Seeder
{
    public function run(): void
    {
        // Default Users (with their roles) ---------------------------------------------
        $admin = app(CreateUserByCredentialsTask::class)->run(true, 'popov.scar@gmail.com', 'admin', 'OLeksii Popov');
        $admin->assignRole(app(FindRoleTask::class)->run('admin'));
        $admin->email_verified_at = now();
        $admin->save();
    }
}

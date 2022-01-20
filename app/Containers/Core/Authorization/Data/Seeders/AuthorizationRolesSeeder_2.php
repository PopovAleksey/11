<?php

namespace App\Containers\Core\Authorization\Data\Seeders;

use App\Containers\Core\Authorization\Tasks\CreateRoleTask;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationRolesSeeder_2 extends Seeder
{
    public function run(): void
    {
        // Default Roles ----------------------------------------------------------------
        app(CreateRoleTask::class)->run('admin', 'Administrator', 'Administrator Role', 999);
    }
}

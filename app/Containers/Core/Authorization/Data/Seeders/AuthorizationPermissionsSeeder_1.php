<?php

namespace App\Containers\Core\Authorization\Data\Seeders;

use App\Containers\Core\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationPermissionsSeeder_1 extends Seeder
{
    public function run(): void
    {
        // Default Permissions ----------------------------------------------------------
        $createPermissionTask = app(CreatePermissionTask::class);
        $createPermissionTask->run('manage-roles', 'Create, Update, Delete, Get All, Attach/detach permissions to Roles and Get All Permissions.');
        $createPermissionTask->run('create-admins', 'Create new Users (Admins) from the dashboard.');
        $createPermissionTask->run('manage-admins-access', 'Assign users to Roles.');
        $createPermissionTask->run('access-dashboard', 'Access the admins dashboard.');
    }
}

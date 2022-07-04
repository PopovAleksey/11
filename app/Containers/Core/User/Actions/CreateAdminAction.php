<?php

namespace App\Containers\Core\User\Actions;

use App\Containers\Core\Authorization\Tasks\AssignUserToRoleTaskInterface;
use App\Containers\Core\User\Data\Dto\UserDto;
use App\Containers\Core\User\Tasks\CreateUserByCredentialsTaskInterface;
use App\Ship\Parents\Actions\Action;

class CreateAdminAction extends Action implements CreateAdminActionInterface
{
    public function __construct(
        private readonly CreateUserByCredentialsTaskInterface $createUserByCredentialsTask,
        private readonly AssignUserToRoleTaskInterface        $assignUserToRoleTask
    )
    {
    }

    /**
     * @param \App\Containers\Core\User\Data\Dto\UserDto $userDto
     * @return \App\Containers\Core\User\Data\Dto\UserDto
     * @throws \PopovAleksey\Mapper\MapperException
     */
    public function run(UserDto $userDto): UserDto
    {
        $admin = $this->createUserByCredentialsTask->run(
            true,
            $userDto->getEmail(),
            $userDto->getPassword(),
            $userDto->getName()
        );

        // NOTE: if not using a single general role for all Admins, comment out that line below. And assign Roles
        // to your users manually. (To list admins in your dashboard look for users with `is_admin=true`).
        $this->assignUserToRoleTask->run($admin, ['admin']);

        return (new UserDto())->handler($admin->toArray());
    }
}

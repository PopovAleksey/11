<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\Authorization\Tasks\AssignUserToRoleTaskInterface;
use App\Containers\AppSection\User\Data\Dto\UserDto;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTaskInterface;
use App\Ship\Parents\Actions\Action;

class CreateAdminAction extends Action implements CreateAdminActionInterface
{
    public function __construct(
        private CreateUserByCredentialsTaskInterface $createUserByCredentialsTask,
        private AssignUserToRoleTaskInterface        $assignUserToRoleTask
    )
    {
    }

    /**
     * @param \App\Containers\AppSection\User\Data\Dto\UserDto $userDto
     * @return \App\Containers\AppSection\User\Data\Dto\UserDto
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

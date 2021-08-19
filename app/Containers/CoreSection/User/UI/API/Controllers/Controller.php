<?php

namespace App\Containers\CoreSection\User\UI\API\Controllers;

use App\Containers\CoreSection\User\UI\API\Requests\CreateUserRequest;
use App\Containers\CoreSection\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\CoreSection\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\CoreSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\CoreSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\CoreSection\User\UI\API\Transformers\UserTransformer;
use App\Containers\CoreSection\User\Actions\CreateUserAction;
use App\Containers\CoreSection\User\Actions\FindUserByIdAction;
use App\Containers\CoreSection\User\Actions\GetAllUsersAction;
use App\Containers\CoreSection\User\Actions\UpdateUserAction;
use App\Containers\CoreSection\User\Actions\DeleteUserAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $user = app(CreateUserAction::class)->run($request);
        return $this->created($this->transform($user, UserTransformer::class));
    }

    public function findUserById(FindUserByIdRequest $request): array
    {
        $user = app(FindUserByIdAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function getAllUsers(GetAllUsersRequest $request): array
    {
        $users = app(GetAllUsersAction::class)->run($request);
        return $this->transform($users, UserTransformer::class);
    }

    public function updateUser(UpdateUserRequest $request): array
    {
        $user = app(UpdateUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function deleteUser(DeleteUserRequest $request): JsonResponse
    {
        app(DeleteUserAction::class)->run($request);
        return $this->noContent();
    }
}

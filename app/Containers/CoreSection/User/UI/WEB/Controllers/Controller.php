<?php

namespace App\Containers\CoreSection\User\UI\WEB\Controllers;

use App\Containers\CoreSection\User\UI\WEB\Requests\CreateUserRequest;
use App\Containers\CoreSection\User\UI\WEB\Requests\DeleteUserRequest;
use App\Containers\CoreSection\User\UI\WEB\Requests\GetAllUsersRequest;
use App\Containers\CoreSection\User\UI\WEB\Requests\FindUserByIdRequest;
use App\Containers\CoreSection\User\UI\WEB\Requests\UpdateUserRequest;
use App\Containers\CoreSection\User\UI\WEB\Requests\StoreUserRequest;
use App\Containers\CoreSection\User\UI\WEB\Requests\EditUserRequest;
use App\Containers\CoreSection\User\Actions\CreateUserAction;
use App\Containers\CoreSection\User\Actions\FindUserByIdAction;
use App\Containers\CoreSection\User\Actions\GetAllUsersAction;
use App\Containers\CoreSection\User\Actions\UpdateUserAction;
use App\Containers\CoreSection\User\Actions\DeleteUserAction;
use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
    public function index(GetAllUsersRequest $request)
    {
        $users = app(GetAllUsersAction::class)->run($request);
        // ..
    }

    public function show(FindUserByIdRequest $request)
    {
        $user = app(FindUserByIdAction::class)->run($request);
        // ..
    }

    public function create(CreateUserRequest $request)
    {
        // ..
    }

    public function store(StoreUserRequest $request)
    {
        $user = app(CreateUserAction::class)->run($request);
        // ..
    }

    public function edit(EditUserRequest $request)
    {
        $user = app(FindUserByIdAction::class)->run($request);
        // ..
    }

    public function update(UpdateUserRequest $request)
    {
        $user = app(UpdateUserAction::class)->run($request);
        // ..
    }

    public function destroy(DeleteUserRequest $request)
    {
         $result = app(DeleteUserAction::class)->run($request);
         // ..
    }
}

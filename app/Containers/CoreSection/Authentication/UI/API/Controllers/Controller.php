<?php

namespace App\Containers\CoreSection\Authentication\UI\API\Controllers;

use App\Containers\CoreSection\Authentication\UI\API\Requests\CreateAuthenticationRequest;
use App\Containers\CoreSection\Authentication\UI\API\Requests\DeleteAuthenticationRequest;
use App\Containers\CoreSection\Authentication\UI\API\Requests\GetAllAuthenticationsRequest;
use App\Containers\CoreSection\Authentication\UI\API\Requests\FindAuthenticationByIdRequest;
use App\Containers\CoreSection\Authentication\UI\API\Requests\UpdateAuthenticationRequest;
use App\Containers\CoreSection\Authentication\UI\API\Transformers\AuthenticationTransformer;
use App\Containers\CoreSection\Authentication\Actions\CreateAuthenticationAction;
use App\Containers\CoreSection\Authentication\Actions\FindAuthenticationByIdAction;
use App\Containers\CoreSection\Authentication\Actions\GetAllAuthenticationsAction;
use App\Containers\CoreSection\Authentication\Actions\UpdateAuthenticationAction;
use App\Containers\CoreSection\Authentication\Actions\DeleteAuthenticationAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function createAuthentication(CreateAuthenticationRequest $request): JsonResponse
    {
        $authentication = app(CreateAuthenticationAction::class)->run($request);
        return $this->created($this->transform($authentication, AuthenticationTransformer::class));
    }

    public function findAuthenticationById(FindAuthenticationByIdRequest $request): array
    {
        $authentication = app(FindAuthenticationByIdAction::class)->run($request);
        return $this->transform($authentication, AuthenticationTransformer::class);
    }

    public function getAllAuthentications(GetAllAuthenticationsRequest $request): array
    {
        $authentications = app(GetAllAuthenticationsAction::class)->run($request);
        return $this->transform($authentications, AuthenticationTransformer::class);
    }

    public function updateAuthentication(UpdateAuthenticationRequest $request): array
    {
        $authentication = app(UpdateAuthenticationAction::class)->run($request);
        return $this->transform($authentication, AuthenticationTransformer::class);
    }

    public function deleteAuthentication(DeleteAuthenticationRequest $request): JsonResponse
    {
        app(DeleteAuthenticationAction::class)->run($request);
        return $this->noContent();
    }
}

<?php

namespace App\Containers\Core\Authentication\Actions;

use App\Containers\Core\Authentication\UI\API\Requests\LogoutRequest;
use App\Ship\Parents\Actions\Action;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser;

class ApiLogoutAction extends Action
{
    public function run(LogoutRequest $request): void
    {
        $id = app(Parser::class)->parse($request->bearerToken())->claims()->get('jti');
        app(TokenRepository::class)->revokeAccessToken($id);
        app(RefreshTokenRepository::class)->revokeRefreshTokensByAccessTokenId($id);
    }
}

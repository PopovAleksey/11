<?php

namespace App\Containers\Core\Authentication\Actions\GoogleOAuth;

use App\Ship\Parents\Actions\Action;
use Google_Client;
use Google_Service_PeopleService;

class GetAuthLinkAction extends Action implements GetAuthLinkActionInterface
{
    /**
     * @param \Google_Client $googleClient
     * @throws \Google\Exception
     */
    public function __construct(
        private readonly Google_Client $googleClient
    )
    {
        $constFile = config('appSection-authentication.oauth.google.config_file');

        if (empty($constFile)) {
            $this->googleClient->setClientId(config('appSection-authentication.oauth.google.client_id'));
            $this->googleClient->setClientSecret(config('appSection-authentication.oauth.google.client_secret'));
        } else {
            $this->googleClient->setAuthConfig(storage_path($constFile));
        }

        $this->googleClient->setRedirectUri(route(config('appSection-authentication.oauth.google.callback')));
        $this->googleClient->setScopes([
            Google_Service_PeopleService::USERINFO_PROFILE,
            Google_Service_PeopleService::USERINFO_EMAIL,
        ]);
    }

    public function run(): string
    {
        return $this->googleClient->createAuthUrl();
    }
}

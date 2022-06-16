<?php

namespace App\Containers\Core\Authentication\Actions\GoogleOAuth;

use App\Ship\Parents\Actions\Action;
use Google_Client;
use Google_Service_PeopleService;

class GetAuthLinkAction extends Action implements GetAuthLinkActionInterface
{
    /**
     * @throws \Google\Exception
     */
    public function __construct(private Google_Client $googleClient)
    {
        $this->googleClient->setAuthConfig(storage_path(config('appSection-authentication.oauth.google.config_file')));
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

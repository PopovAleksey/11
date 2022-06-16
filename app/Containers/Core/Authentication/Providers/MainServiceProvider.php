<?php

namespace App\Containers\Core\Authentication\Providers;

use App\Containers\Core\Authentication\Actions\GoogleOAuth\GetAuthLinkAction;
use App\Containers\Core\Authentication\Actions\GoogleOAuth\GetAuthLinkActionInterface;
use App\Containers\Core\Authentication\Actions\GoogleOAuth\SignInAction;
use App\Containers\Core\Authentication\Actions\GoogleOAuth\SignInActionInterface;
use App\Containers\Core\Authentication\Actions\WebLoginAction;
use App\Containers\Core\Authentication\Actions\WebLoginActionInterface;
use App\Containers\Core\Authentication\Actions\WebLogoutAction;
use App\Containers\Core\Authentication\Actions\WebLogoutActionInterface;
use App\Containers\Core\Authentication\Tasks\CheckIfUserEmailIsConfirmedTask;
use App\Containers\Core\Authentication\Tasks\CheckIfUserEmailIsConfirmedTaskInterface;
use App\Containers\Core\Authentication\Tasks\GoogleOAuth\GetAuthCredentialsTask;
use App\Containers\Core\Authentication\Tasks\GoogleOAuth\GetAuthCredentialsTaskInterface;
use App\Containers\Core\Authentication\Tasks\LoginTask;
use App\Containers\Core\Authentication\Tasks\LoginTaskInterface;
use App\Ship\Parents\Providers\MainProvider;
use Laravel\Passport\PassportServiceProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MainServiceProvider extends MainProvider
{
    /**
     * Container Service Providers.
     */
    public array $serviceProviders = [
        PassportServiceProvider::class,
        AuthProvider::class,
        MiddlewareServiceProvider::class,
    ];

    /**
     * Container Aliases
     */
    public array $aliases = [

    ];

    public function boot(): void
    {
        $this->bindActions();
        $this->bindTasks();

        parent::boot();
    }

    private function bindActions(): void
    {
        $this->app->bind(WebLogoutActionInterface::class, WebLogoutAction::class);
        $this->app->bind(WebLoginActionInterface::class, WebLoginAction::class);
        $this->app->bind(GetAuthLinkActionInterface::class, GetAuthLinkAction::class);
        $this->app->bind(SignInActionInterface::class, SignInAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(LoginTaskInterface::class, LoginTask::class);
        $this->app->bind(CheckIfUserEmailIsConfirmedTaskInterface::class, CheckIfUserEmailIsConfirmedTask::class);
        $this->app->bind(GetAuthCredentialsTaskInterface::class, GetAuthCredentialsTask::class);
    }
}

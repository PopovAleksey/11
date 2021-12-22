<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Actions\WebLoginActionInterface;
use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\Actions\WebLogoutActionInterface;
use App\Containers\AppSection\Authentication\Tasks\CheckIfUserEmailIsConfirmedTask;
use App\Containers\AppSection\Authentication\Tasks\CheckIfUserEmailIsConfirmedTaskInterface;
use App\Containers\AppSection\Authentication\Tasks\LoginTask;
use App\Containers\AppSection\Authentication\Tasks\LoginTaskInterface;
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
    }

    private function bindTasks(): void
    {
        $this->app->bind(LoginTaskInterface::class, LoginTask::class);
        $this->app->bind(CheckIfUserEmailIsConfirmedTaskInterface::class, CheckIfUserEmailIsConfirmedTask::class);
    }
}

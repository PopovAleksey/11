<?php

namespace App\Containers\AppSection\User\Providers;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Models\UserInterface;
use App\Ship\Parents\Providers\MainProvider;

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
        // InternalServiceProviderExample::class,
        // ...
    ];

    /**
     * Container Aliases
     */
    public array $aliases = [

    ];

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();

        // do your binding here..
        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->bindModels();

        parent::boot(); // TODO: Change the autogenerated stub
    }

    /**
     * @return void
     */
    private function bindModels(): void
    {
        $this->app->bind(UserInterface::class, User::class);
    }
}

<?php

namespace App\Containers\AppSection\User\Providers;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\Actions\CreateAdminActionInterface;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Data\Repositories\UserRepositoryInterface;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Models\UserInterface;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTaskInterface;
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

        $this->bindActions();
        $this->bindTasks();
        $this->bindRepositories();
        $this->bindModels();
    }

    private function bindActions(): void
    {
        $this->app->bind(CreateAdminActionInterface::class, CreateAdminAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(CreateUserByCredentialsTaskInterface::class, CreateUserByCredentialsTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(UserInterface::class, User::class);
    }
}

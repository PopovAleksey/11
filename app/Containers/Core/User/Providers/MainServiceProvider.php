<?php

namespace App\Containers\Core\User\Providers;

use App\Containers\Core\User\Actions\CreateAdminAction;
use App\Containers\Core\User\Actions\CreateAdminActionInterface;
use App\Containers\Core\User\Data\Repositories\UserRepository;
use App\Containers\Core\User\Data\Repositories\UserRepositoryInterface;
use App\Containers\Core\User\Models\User;
use App\Containers\Core\User\Models\UserInterface;
use App\Containers\Core\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\Core\User\Tasks\CreateUserByCredentialsTaskInterface;
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

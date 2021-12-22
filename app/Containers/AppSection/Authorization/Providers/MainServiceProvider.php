<?php

namespace App\Containers\AppSection\Authorization\Providers;

use App\Containers\AppSection\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\AppSection\Authorization\Tasks\AssignUserToRoleTaskInterface;
use App\Ship\Parents\Providers\MainProvider;
use Spatie\Permission\PermissionServiceProvider;

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
        PermissionServiceProvider::class,
        MiddlewareServiceProvider::class,
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
    }

    private function bindTasks(): void
    {
        $this->app->bind(AssignUserToRoleTaskInterface::class, AssignUserToRoleTask::class);
    }

    private function bindRepositories(): void
    {
    }

    private function bindModels(): void
    {
    }
}

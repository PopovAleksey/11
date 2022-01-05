<?php

namespace App\Containers\Development\Logger\Providers;

use App\Containers\Development\Logger\Actions\LoggerAction;
use App\Containers\Development\Logger\Actions\LoggerActionInterface;
use App\Containers\Development\Logger\Data\Repositories\LoggerRepository;
use App\Containers\Development\Logger\Data\Repositories\LoggerRepositoryInterface;
use App\Containers\Development\Logger\Models\Logger;
use App\Containers\Development\Logger\Models\LoggerInterface;
use App\Containers\Development\Logger\Tasks\SQLLoggerTask;
use App\Containers\Development\Logger\Tasks\SQLLoggerTaskInterface;
use App\Ship\Parents\Providers\MainProvider;

/**
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends MainProvider
{
    /**
     * Container Service Providers.
     */
    public array $serviceProviders = [
        // InternalServiceProviderExample::class,
    ];

    /**
     * Container Aliases
     */
    public array $aliases = [
        // 'Foo' => Bar::class,
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

        app(LoggerActionInterface::class)->run();
    }

    private function bindActions(): void
    {
        $this->app->bind(LoggerActionInterface::class, LoggerAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(SQLLoggerTaskInterface::class, SQLLoggerTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(LoggerRepositoryInterface::class, LoggerRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(LoggerInterface::class, Logger::class);
    }
}

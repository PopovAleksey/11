<?php

namespace App\Containers\Constructor\Language\Providers;

use App\Ship\Parents\Providers\MainProvider;

/**
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends MainProvider
{
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
    }

    private function bindRepositories(): void
    {
    }

    private function bindModels(): void
    {
    }
}

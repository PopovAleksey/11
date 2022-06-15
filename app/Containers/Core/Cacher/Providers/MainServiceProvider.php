<?php

namespace App\Containers\Core\Cacher\Providers;

use App\Containers\Core\Cacher\Actions\CacheAction;
use App\Containers\Core\Cacher\Actions\CacheActionInterface;
use App\Containers\Core\Cacher\Tasks\CacheTask;
use App\Containers\Core\Cacher\Tasks\CacheTaskInterface;
use App\Ship\Parents\Providers\MainProvider;


class MainServiceProvider extends MainProvider
{
    public function register(): void
    {
        parent::register();

        $this->bindActions();
        $this->bindTasks();
    }

    private function bindActions(): void
    {
        $this->app->bind(CacheActionInterface::class, CacheAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(CacheTaskInterface::class, CacheTask::class);
    }
}

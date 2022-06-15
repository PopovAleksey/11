<?php

namespace App\Containers\Core\Cacher\Providers;

use App\Containers\Core\Cacher\Actions\CacheAction;
use App\Containers\Core\Cacher\Actions\CacheActionInterface;
use App\Containers\Core\Cacher\Actions\ForgetCacheAction;
use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Tasks\CreateCacheTask;
use App\Containers\Core\Cacher\Tasks\CreateCacheTaskInterface;
use App\Containers\Core\Cacher\Tasks\FindCacheTask;
use App\Containers\Core\Cacher\Tasks\FindCacheTaskInterface;
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
        $this->app->bind(ForgetCacheActionInterface::class, ForgetCacheAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(FindCacheTaskInterface::class, FindCacheTask::class);
        $this->app->bind(CreateCacheTaskInterface::class, CreateCacheTask::class);
    }
}

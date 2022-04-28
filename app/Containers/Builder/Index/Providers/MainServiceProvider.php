<?php

namespace App\Containers\Builder\Index\Providers;

use App\Containers\Builder\Index\Actions\IndexBuilderAction;
use App\Containers\Builder\Index\Actions\IndexBuilderActionInterface;
use App\Containers\Builder\Index\Tasks\IndexBuilderTask;
use App\Containers\Builder\Index\Tasks\IndexBuilderTaskInterface;
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
        $this->app->bind(IndexBuilderActionInterface::class, IndexBuilderAction::class);

    }

    private function bindTasks(): void
    {
        $this->app->bind(IndexBuilderTaskInterface::class, IndexBuilderTask::class);
    }
}

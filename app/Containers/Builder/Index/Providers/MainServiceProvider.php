<?php

namespace App\Containers\Builder\Index\Providers;

use App\Containers\Builder\Index\Actions\BuildTemplateAction;
use App\Containers\Builder\Index\Actions\BuildTemplateActionInterface;
use App\Containers\Builder\Index\Tasks\FindLanguageTask;
use App\Containers\Builder\Index\Tasks\FindLanguageTaskInterface;
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
        $this->app->bind(BuildTemplateActionInterface::class, BuildTemplateAction::class);

    }

    private function bindTasks(): void
    {
        $this->app->bind(FindLanguageTaskInterface::class, FindLanguageTask::class);
        $this->app->bind(IndexBuilderTaskInterface::class, IndexBuilderTask::class);
    }
}

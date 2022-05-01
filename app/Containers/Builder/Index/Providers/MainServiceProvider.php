<?php

namespace App\Containers\Builder\Index\Providers;

use App\Containers\Builder\Index\Actions\BuildTemplateAction;
use App\Containers\Builder\Index\Actions\BuildTemplateActionInterface;
use App\Containers\Builder\Index\Tasks\FindContentTask;
use App\Containers\Builder\Index\Tasks\FindContentTaskInterface;
use App\Containers\Builder\Index\Tasks\FindLanguageTask;
use App\Containers\Builder\Index\Tasks\FindLanguageTaskInterface;
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
        $this->app->bind(FindContentTaskInterface::class, FindContentTask::class);
    }
}

<?php

namespace App\Containers\Builder\Index\Providers;

use App\Containers\Builder\Index\Actions\BuildTemplateAction;
use App\Containers\Builder\Index\Actions\BuildTemplateActionInterface;
use App\Containers\Builder\Index\Actions\GetContentCssOrJsAction;
use App\Containers\Builder\Index\Actions\GetContentCssOrJsActionInterface;
use App\Containers\Builder\Index\Tasks\Builder\BuildBaseJSandCSSTask;
use App\Containers\Builder\Index\Tasks\Builder\BuildBaseJSandCSSTaskInterface;
use App\Containers\Builder\Index\Tasks\Builder\BuildMenuTask;
use App\Containers\Builder\Index\Tasks\Builder\BuildMenuTaskInterface;
use App\Containers\Builder\Index\Tasks\Builder\BuildPageTask;
use App\Containers\Builder\Index\Tasks\Builder\BuildPageTaskInterface;
use App\Containers\Builder\Index\Tasks\Builder\BuildTask;
use App\Containers\Builder\Index\Tasks\Builder\BuildTaskInterface;
use App\Containers\Builder\Index\Tasks\FindContentsTask;
use App\Containers\Builder\Index\Tasks\FindContentsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindLanguagesTask;
use App\Containers\Builder\Index\Tasks\FindLanguagesTaskInterface;
use App\Containers\Builder\Index\Tasks\FindMenuItemsTask;
use App\Containers\Builder\Index\Tasks\FindMenuItemsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindTemplatesTask;
use App\Containers\Builder\Index\Tasks\FindTemplatesTaskInterface;
use App\Containers\Builder\Index\Tasks\FindWidgetsTask;
use App\Containers\Builder\Index\Tasks\FindWidgetsTaskInterface;
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
        $this->app->bind(FindLanguagesTaskInterface::class, FindLanguagesTask::class);
        $this->app->bind(FindContentsTaskInterface::class, FindContentsTask::class);
        $this->app->bind(FindTemplatesTaskInterface::class, FindTemplatesTask::class);
        $this->app->bind(FindMenuItemsTaskInterface::class, FindMenuItemsTask::class);
        $this->app->bind(FindWidgetsTaskInterface::class, FindWidgetsTask::class);

        $this->app->bind(BuildTaskInterface::class, BuildTask::class);
        $this->app->bind(BuildBaseJSandCSSTaskInterface::class, BuildBaseJSandCSSTask::class);
        $this->app->bind(BuildMenuTaskInterface::class, BuildMenuTask::class);
        $this->app->bind(BuildPageTaskInterface::class, BuildPageTask::class);

        $this->app->bind(GetContentCssOrJsActionInterface::class, GetContentCssOrJsAction::class);
    }
}

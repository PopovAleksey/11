<?php

namespace App\Containers\ConstructorSection\Site\Providers;

use App\Containers\ConstructorSection\Site\Actions\CreateSiteAction;
use App\Containers\ConstructorSection\Site\Actions\DeleteSiteAction;
use App\Containers\ConstructorSection\Site\Actions\FindSiteByIdAction;
use App\Containers\ConstructorSection\Site\Actions\GetAllSitesAction;
use App\Containers\ConstructorSection\Site\Actions\UpdateSiteAction;
use App\Containers\ConstructorSection\Site\Data\Repositories\SiteRepository;
use App\Containers\ConstructorSection\Site\Interfaces\Actions\CreateSiteActionInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Actions\DeleteSiteActionInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Actions\FindSiteByIdActionInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Actions\GetAllSitesActionInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Actions\UpdateSiteActionInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Models\SiteInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Repositories\SiteRepositoryInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\CreateSiteTaskInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\DeleteSiteTaskInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\FindSiteByIdTaskInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\GetAllSitesTaskInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\UpdateSiteTaskInterface;
use App\Containers\ConstructorSection\Site\Models\Site;
use App\Containers\ConstructorSection\Site\Tasks\CreateSiteTask;
use App\Containers\ConstructorSection\Site\Tasks\DeleteSiteTask;
use App\Containers\ConstructorSection\Site\Tasks\FindSiteByIdTask;
use App\Containers\ConstructorSection\Site\Tasks\GetAllSitesTask;
use App\Containers\ConstructorSection\Site\Tasks\UpdateSiteTask;
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
        $this->bindRepository();
        $this->bindModels();
    }

    private function bindActions(): void
    {
        $this->app->bind(CreateSiteActionInterface::class, CreateSiteAction::class);
        $this->app->bind(DeleteSiteActionInterface::class, DeleteSiteAction::class);
        $this->app->bind(GetAllSitesActionInterface::class, GetAllSitesAction::class);
        $this->app->bind(UpdateSiteActionInterface::class, UpdateSiteAction::class);
        $this->app->bind(FindSiteByIdActionInterface::class, FindSiteByIdAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(CreateSiteTaskInterface::class, CreateSiteTask::class);
        $this->app->bind(DeleteSiteTaskInterface::class, DeleteSiteTask::class);
        $this->app->bind(GetAllSitesTaskInterface::class, GetAllSitesTask::class);
        $this->app->bind(UpdateSiteTaskInterface::class, UpdateSiteTask::class);
        $this->app->bind(FindSiteByIdTaskInterface::class, FindSiteByIdTask::class);
    }

    private function bindRepository(): void
    {
        $this->app->bind(SiteRepositoryInterface::class, SiteRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(SiteInterface::class, Site::class);
    }
}

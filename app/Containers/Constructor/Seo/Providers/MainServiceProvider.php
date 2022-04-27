<?php

namespace App\Containers\Constructor\Seo\Providers;

use App\Containers\Constructor\Seo\Actions\CreateSeoAction;
use App\Containers\Constructor\Seo\Actions\CreateSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\DeleteSeoAction;
use App\Containers\Constructor\Seo\Actions\DeleteSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\GetAllSeoAction;
use App\Containers\Constructor\Seo\Actions\GetAllSeoActionInterface;
use App\Containers\Constructor\Seo\Actions\UpdateSeoAction;
use App\Containers\Constructor\Seo\Actions\UpdateSeoActionInterface;
use App\Containers\Constructor\Seo\Models\Seo;
use App\Containers\Constructor\Seo\Models\SeoInterface;
use App\Containers\Constructor\Seo\Models\SeoLink;
use App\Containers\Constructor\Seo\Models\SeoLinkInterface;
use App\Containers\Constructor\Seo\Tasks\CreateSeoTask;
use App\Containers\Constructor\Seo\Tasks\CreateSeoTaskInterface;
use App\Containers\Constructor\Seo\Tasks\DeleteSeoTask;
use App\Containers\Constructor\Seo\Tasks\DeleteSeoTaskInterface;
use App\Containers\Constructor\Seo\Tasks\GetAllSeoTask;
use App\Containers\Constructor\Seo\Tasks\GetAllSeoTaskInterface;
use App\Containers\Constructor\Seo\Tasks\UpdateSeoTask;
use App\Containers\Constructor\Seo\Tasks\UpdateSeoTaskInterface;
use App\Ship\Parents\Providers\MainProvider;
use App\Ship\Parents\Repositories\SeoLinkRepository;
use App\Ship\Parents\Repositories\SeoLinkRepositoryInterface;
use App\Ship\Parents\Repositories\SeoRepository;
use App\Ship\Parents\Repositories\SeoRepositoryInterface;


class MainServiceProvider extends MainProvider
{
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
        $this->app->bind(GetAllSeoActionInterface::class, GetAllSeoAction::class);
        $this->app->bind(CreateSeoActionInterface::class, CreateSeoAction::class);
        $this->app->bind(UpdateSeoActionInterface::class, UpdateSeoAction::class);
        $this->app->bind(DeleteSeoActionInterface::class, DeleteSeoAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(GetAllSeoTaskInterface::class, GetAllSeoTask::class);
        $this->app->bind(CreateSeoTaskInterface::class, CreateSeoTask::class);
        $this->app->bind(UpdateSeoTaskInterface::class, UpdateSeoTask::class);
        $this->app->bind(DeleteSeoTaskInterface::class, DeleteSeoTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(SeoRepositoryInterface::class, SeoRepository::class);
        $this->app->bind(SeoLinkRepositoryInterface::class, SeoLinkRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(SeoInterface::class, Seo::class);
        $this->app->bind(SeoLinkInterface::class, SeoLink::class);
    }
}

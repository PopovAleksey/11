<?php

namespace App\Containers\Constructor\Seo\Providers;

use App\Containers\Constructor\Seo\Actions\GetAllSeoAction;
use App\Containers\Constructor\Seo\Actions\GetAllSeoActionInterface;
use App\Containers\Constructor\Seo\Data\Repositories\SeoRepository;
use App\Containers\Constructor\Seo\Data\Repositories\SeoRepositoryInterface;
use App\Containers\Constructor\Seo\Models\Seo;
use App\Containers\Constructor\Seo\Models\SeoInterface;
use App\Containers\Constructor\Seo\Tasks\GetAllSeoTask;
use App\Containers\Constructor\Seo\Tasks\GetAllSeoTaskInterface;
use App\Ship\Parents\Providers\MainProvider;


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
    }

    private function bindTasks(): void
    {
        $this->app->bind(GetAllSeoTaskInterface::class, GetAllSeoTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(SeoRepositoryInterface::class, SeoRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(SeoInterface::class, Seo::class);
    }
}

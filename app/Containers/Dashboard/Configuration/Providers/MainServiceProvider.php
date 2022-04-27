<?php

namespace App\Containers\Dashboard\Configuration\Providers;

use App\Containers\Dashboard\Configuration\Actions\GetAllMenuConfigurationAction;
use App\Containers\Dashboard\Configuration\Actions\GetAllMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\UpdateMenuConfigurationAction;
use App\Containers\Dashboard\Configuration\Actions\UpdateMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Tasks\GetAllMenuConfigurationTask;
use App\Containers\Dashboard\Configuration\Tasks\GetAllMenuConfigurationTaskInterface;
use App\Containers\Dashboard\Configuration\Tasks\UpdateMenuConfigurationTask;
use App\Containers\Dashboard\Configuration\Tasks\UpdateMenuConfigurationTaskInterface;
use App\Ship\Parents\Models\ConfigurationMenu;
use App\Ship\Parents\Models\ConfigurationMenuInterface;
use App\Ship\Parents\Providers\MainProvider;
use App\Ship\Parents\Repositories\ConfigurationMenuRepository;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;


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
        $this->app->bind(GetAllMenuConfigurationActionInterface::class, GetAllMenuConfigurationAction::class);
        $this->app->bind(UpdateMenuConfigurationActionInterface::class, UpdateMenuConfigurationAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(GetAllMenuConfigurationTaskInterface::class, GetAllMenuConfigurationTask::class);
        $this->app->bind(UpdateMenuConfigurationTaskInterface::class, UpdateMenuConfigurationTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(ConfigurationMenuRepositoryInterface::class, ConfigurationMenuRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(ConfigurationMenuInterface::class, ConfigurationMenu::class);
    }
}

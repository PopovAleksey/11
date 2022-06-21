<?php

namespace App\Containers\Constructor\Localization\Providers;

use App\Containers\Constructor\Localization\Actions\GetAllLocalizationsAction;
use App\Containers\Constructor\Localization\Actions\GetAllLocalizationsActionInterface;
use App\Containers\Constructor\Localization\Tasks\GetAllLocalizationsTask;
use App\Containers\Constructor\Localization\Tasks\GetAllLocalizationsTaskInterface;
use App\Ship\Parents\Models\Localization;
use App\Ship\Parents\Models\LocalizationInterface;
use App\Ship\Parents\Models\LocalizationValues;
use App\Ship\Parents\Models\LocalizationValuesInterface;
use App\Ship\Parents\Providers\MainProvider;
use App\Ship\Parents\Repositories\LocalizationRepository;
use App\Ship\Parents\Repositories\LocalizationRepositoryInterface;


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
        $this->app->bind(GetAllLocalizationsActionInterface::class, GetAllLocalizationsAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(GetAllLocalizationsTaskInterface::class, GetAllLocalizationsTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(LocalizationRepositoryInterface::class, LocalizationRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(LocalizationInterface::class, Localization::class);
        $this->app->bind(LocalizationValuesInterface::class, LocalizationValues::class);
    }
}

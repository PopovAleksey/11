<?php

namespace App\Containers\Constructor\Localization\Providers;

use App\Containers\Constructor\Localization\Actions\FindLocalizationByIdAction;
use App\Containers\Constructor\Localization\Actions\FindLocalizationByIdActionInterface;
use App\Containers\Constructor\Localization\Actions\GetAllLanguagesAction;
use App\Containers\Constructor\Localization\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Localization\Actions\GetAllLocalizationsAction;
use App\Containers\Constructor\Localization\Actions\GetAllLocalizationsActionInterface;
use App\Containers\Constructor\Localization\Actions\GetAllThemesAction;
use App\Containers\Constructor\Localization\Actions\GetAllThemesActionInterface;
use App\Containers\Constructor\Localization\Tasks\FindLocalizationByIdTask;
use App\Containers\Constructor\Localization\Tasks\FindLocalizationByIdTaskInterface;
use App\Containers\Constructor\Localization\Tasks\GetAllLanguagesTask;
use App\Containers\Constructor\Localization\Tasks\GetAllLanguagesTaskInterface;
use App\Containers\Constructor\Localization\Tasks\GetAllLocalizationsTask;
use App\Containers\Constructor\Localization\Tasks\GetAllLocalizationsTaskInterface;
use App\Containers\Constructor\Localization\Tasks\GetAllThemesTask;
use App\Containers\Constructor\Localization\Tasks\GetAllThemesTaskInterface;
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
        $this->app->bind(GetAllLanguagesActionInterface::class, GetAllLanguagesAction::class);
        $this->app->bind(GetAllThemesActionInterface::class, GetAllThemesAction::class);
        $this->app->bind(FindLocalizationByIdActionInterface::class, FindLocalizationByIdAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(GetAllLocalizationsTaskInterface::class, GetAllLocalizationsTask::class);
        $this->app->bind(GetAllLanguagesTaskInterface::class, GetAllLanguagesTask::class);
        $this->app->bind(GetAllThemesTaskInterface::class, GetAllThemesTask::class);
        $this->app->bind(FindLocalizationByIdTaskInterface::class, FindLocalizationByIdTask::class);
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

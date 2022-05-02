<?php

namespace App\Containers\Dashboard\Configuration\Providers;

use App\Containers\Builder\Index\Tasks\BuildPageTask;
use App\Containers\Builder\Index\Tasks\BuildPageTaskInterface;
use App\Containers\Dashboard\Configuration\Actions\GetAllCommonConfigurationAction;
use App\Containers\Dashboard\Configuration\Actions\GetAllCommonConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\GetAllMenuConfigurationAction;
use App\Containers\Dashboard\Configuration\Actions\GetAllMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\UpdateCommonConfigurationAction;
use App\Containers\Dashboard\Configuration\Actions\UpdateCommonConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Actions\UpdateMenuConfigurationAction;
use App\Containers\Dashboard\Configuration\Actions\UpdateMenuConfigurationActionInterface;
use App\Containers\Dashboard\Configuration\Tasks\GetAllCommonConfigurationTask;
use App\Containers\Dashboard\Configuration\Tasks\GetAllCommonConfigurationTaskInterface;
use App\Containers\Dashboard\Configuration\Tasks\GetAllMenuConfigurationTask;
use App\Containers\Dashboard\Configuration\Tasks\GetAllMenuConfigurationTaskInterface;
use App\Containers\Dashboard\Configuration\Tasks\UpdateCommonConfigurationTask;
use App\Containers\Dashboard\Configuration\Tasks\UpdateCommonConfigurationTaskInterface;
use App\Containers\Dashboard\Configuration\Tasks\UpdateMenuConfigurationTask;
use App\Containers\Dashboard\Configuration\Tasks\UpdateMenuConfigurationTaskInterface;
use App\Ship\Parents\Models\ConfigurationCommon;
use App\Ship\Parents\Models\ConfigurationCommonInterface;
use App\Ship\Parents\Models\ConfigurationMenu;
use App\Ship\Parents\Models\ConfigurationMenuInterface;
use App\Ship\Parents\Models\Content;
use App\Ship\Parents\Models\ContentInterface;
use App\Ship\Parents\Models\ContentValue;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Models\Language;
use App\Ship\Parents\Models\LanguageInterface;
use App\Ship\Parents\Providers\MainProvider;
use App\Ship\Parents\Repositories\ConfigurationCommonRepository;
use App\Ship\Parents\Repositories\ConfigurationCommonRepositoryInterface;
use App\Ship\Parents\Repositories\ConfigurationMenuRepository;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Repositories\ContentRepository;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Repositories\ContentValueRepository;
use App\Ship\Parents\Repositories\ContentValueRepositoryInterface;
use App\Ship\Parents\Repositories\LanguageRepository;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;


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
        $this->app->bind(GetAllCommonConfigurationActionInterface::class, GetAllCommonConfigurationAction::class);
        $this->app->bind(UpdateMenuConfigurationActionInterface::class, UpdateMenuConfigurationAction::class);
        $this->app->bind(UpdateCommonConfigurationActionInterface::class, UpdateCommonConfigurationAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(GetAllMenuConfigurationTaskInterface::class, GetAllMenuConfigurationTask::class);
        $this->app->bind(GetAllCommonConfigurationTaskInterface::class, GetAllCommonConfigurationTask::class);
        $this->app->bind(UpdateMenuConfigurationTaskInterface::class, UpdateMenuConfigurationTask::class);
        $this->app->bind(UpdateCommonConfigurationTaskInterface::class, UpdateCommonConfigurationTask::class);
        $this->app->bind(BuildPageTaskInterface::class, BuildPageTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(ConfigurationMenuRepositoryInterface::class, ConfigurationMenuRepository::class);
        $this->app->bind(ConfigurationCommonRepositoryInterface::class, ConfigurationCommonRepository::class);
        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(ContentValueRepositoryInterface::class, ContentValueRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(ConfigurationMenuInterface::class, ConfigurationMenu::class);
        $this->app->bind(ConfigurationCommonInterface::class, ConfigurationCommon::class);
        $this->app->bind(LanguageInterface::class, Language::class);
        $this->app->bind(ContentInterface::class, Content::class);
        $this->app->bind(ContentValueInterface::class, ContentValue::class);
    }
}

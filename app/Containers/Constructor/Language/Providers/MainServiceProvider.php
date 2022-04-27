<?php

namespace App\Containers\Constructor\Language\Providers;

use App\Containers\Constructor\Language\Actions\CreateLanguageAction;
use App\Containers\Constructor\Language\Actions\CreateLanguageActionInterface;
use App\Containers\Constructor\Language\Actions\DeleteLanguageAction;
use App\Containers\Constructor\Language\Actions\DeleteLanguageActionInterface;
use App\Containers\Constructor\Language\Actions\GetAllLanguagesAction;
use App\Containers\Constructor\Language\Actions\GetAllLanguagesActionInterface;
use App\Containers\Constructor\Language\Actions\GetPossibleLanguagesAction;
use App\Containers\Constructor\Language\Actions\GetPossibleLanguagesActionInterface;
use App\Containers\Constructor\Language\Actions\UpdateLanguageAction;
use App\Containers\Constructor\Language\Actions\UpdateLanguageActionInterface;
use App\Containers\Constructor\Language\Tasks\CreateLanguageTask;
use App\Containers\Constructor\Language\Tasks\CreateLanguageTaskInterface;
use App\Containers\Constructor\Language\Tasks\DeleteLanguageTask;
use App\Containers\Constructor\Language\Tasks\DeleteLanguageTaskInterface;
use App\Containers\Constructor\Language\Tasks\GetAllLanguagesTask;
use App\Containers\Constructor\Language\Tasks\GetAllLanguagesTaskInterface;
use App\Containers\Constructor\Language\Tasks\UpdateLanguageTask;
use App\Containers\Constructor\Language\Tasks\UpdateLanguageTaskInterface;
use App\Ship\Parents\Models\Language;
use App\Ship\Parents\Models\LanguageInterface;
use App\Ship\Parents\Providers\MainProvider;
use App\Ship\Parents\Repositories\LanguageRepository;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;

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
        $this->bindRepositories();
        $this->bindModels();
    }

    private function bindActions(): void
    {
        $this->app->bind(CreateLanguageActionInterface::class, CreateLanguageAction::class);
        $this->app->bind(GetAllLanguagesActionInterface::class, GetAllLanguagesAction::class);
        $this->app->bind(GetPossibleLanguagesActionInterface::class, GetPossibleLanguagesAction::class);
        $this->app->bind(UpdateLanguageActionInterface::class, UpdateLanguageAction::class);
        $this->app->bind(DeleteLanguageActionInterface::class, DeleteLanguageAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(CreateLanguageTaskInterface::class, CreateLanguageTask::class);
        $this->app->bind(GetAllLanguagesTaskInterface::class, GetAllLanguagesTask::class);
        $this->app->bind(UpdateLanguageTaskInterface::class, UpdateLanguageTask::class);
        $this->app->bind(DeleteLanguageTaskInterface::class, DeleteLanguageTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(LanguageInterface::class, Language::class);
    }
}

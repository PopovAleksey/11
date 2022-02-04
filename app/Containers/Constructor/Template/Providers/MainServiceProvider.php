<?php

namespace App\Containers\Constructor\Template\Providers;

use App\Containers\Constructor\Template\Actions\ActivateThemeAction;
use App\Containers\Constructor\Template\Actions\ActivateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\CreateTemplateAction;
use App\Containers\Constructor\Template\Actions\CreateTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\DeleteTemplateAction;
use App\Containers\Constructor\Template\Actions\DeleteTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\FindTemplateByIdAction;
use App\Containers\Constructor\Template\Actions\FindTemplateByIdActionInterface;
use App\Containers\Constructor\Template\Actions\GetAllTemplatesAction;
use App\Containers\Constructor\Template\Actions\GetAllTemplatesActionInterface;
use App\Containers\Constructor\Template\Actions\GetAllThemesAction;
use App\Containers\Constructor\Template\Actions\GetAllThemesActionInterface;
use App\Containers\Constructor\Template\Actions\UpdateTemplateAction;
use App\Containers\Constructor\Template\Actions\UpdateTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\UpdateThemeAction;
use App\Containers\Constructor\Template\Actions\UpdateThemeActionInterface;
use App\Containers\Constructor\Template\Data\Repositories\TemplateRepository;
use App\Containers\Constructor\Template\Data\Repositories\TemplateRepositoryInterface;
use App\Containers\Constructor\Template\Data\Repositories\ThemeRepository;
use App\Containers\Constructor\Template\Data\Repositories\ThemeRepositoryInterface;
use App\Containers\Constructor\Template\Models\Template;
use App\Containers\Constructor\Template\Models\TemplateInterface;
use App\Containers\Constructor\Template\Models\Theme;
use App\Containers\Constructor\Template\Models\ThemeInterface;
use App\Containers\Constructor\Template\Tasks\ActivateThemeTask;
use App\Containers\Constructor\Template\Tasks\ActivateThemeTaskInterface;
use App\Containers\Constructor\Template\Tasks\CreateTemplateTask;
use App\Containers\Constructor\Template\Tasks\CreateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\DeleteTemplateTask;
use App\Containers\Constructor\Template\Tasks\DeleteTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\FindTemplateByIdTask;
use App\Containers\Constructor\Template\Tasks\FindTemplateByIdTaskInterface;
use App\Containers\Constructor\Template\Tasks\GetAllTemplatesTask;
use App\Containers\Constructor\Template\Tasks\GetAllTemplatesTaskInterface;
use App\Containers\Constructor\Template\Tasks\GetAllThemesTask;
use App\Containers\Constructor\Template\Tasks\GetAllThemesTaskInterface;
use App\Containers\Constructor\Template\Tasks\UpdateTemplateTask;
use App\Containers\Constructor\Template\Tasks\UpdateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\UpdateThemeTask;
use App\Containers\Constructor\Template\Tasks\UpdateThemeTaskInterface;
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
        $this->app->bind(CreateTemplateActionInterface::class, CreateTemplateAction::class);
        $this->app->bind(DeleteTemplateActionInterface::class, DeleteTemplateAction::class);
        $this->app->bind(FindTemplateByIdActionInterface::class, FindTemplateByIdAction::class);
        $this->app->bind(GetAllTemplatesActionInterface::class, GetAllTemplatesAction::class);
        $this->app->bind(UpdateTemplateActionInterface::class, UpdateTemplateAction::class);

        $this->app->bind(GetAllThemesActionInterface::class, GetAllThemesAction::class);
        $this->app->bind(UpdateThemeActionInterface::class, UpdateThemeAction::class);
        $this->app->bind(ActivateThemeActionInterface::class, ActivateThemeAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(CreateTemplateTaskInterface::class, CreateTemplateTask::class);
        $this->app->bind(DeleteTemplateTaskInterface::class, DeleteTemplateTask::class);
        $this->app->bind(FindTemplateByIdTaskInterface::class, FindTemplateByIdTask::class);
        $this->app->bind(GetAllTemplatesTaskInterface::class, GetAllTemplatesTask::class);
        $this->app->bind(UpdateTemplateTaskInterface::class, UpdateTemplateTask::class);

        $this->app->bind(GetAllThemesTaskInterface::class, GetAllThemesTask::class);
        $this->app->bind(UpdateThemeTaskInterface::class, UpdateThemeTask::class);
        $this->app->bind(ActivateThemeTaskInterface::class, ActivateThemeTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(ThemeRepositoryInterface::class, ThemeRepository::class);
        $this->app->bind(TemplateRepositoryInterface::class, TemplateRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(ThemeInterface::class, Theme::class);
        $this->app->bind(TemplateInterface::class, Template::class);
    }
}

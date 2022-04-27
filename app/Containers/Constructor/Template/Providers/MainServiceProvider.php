<?php

namespace App\Containers\Constructor\Template\Providers;

use App\Containers\Constructor\Template\Actions\ActivateThemeAction;
use App\Containers\Constructor\Template\Actions\ActivateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\CreateTemplateAction;
use App\Containers\Constructor\Template\Actions\CreateTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\CreateThemeAction;
use App\Containers\Constructor\Template\Actions\CreateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\DeleteTemplateAction;
use App\Containers\Constructor\Template\Actions\DeleteTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\DeleteThemeAction;
use App\Containers\Constructor\Template\Actions\DeleteThemeActionInterface;
use App\Containers\Constructor\Template\Actions\FindTemplateByIdAction;
use App\Containers\Constructor\Template\Actions\FindTemplateByIdActionInterface;
use App\Containers\Constructor\Template\Actions\FindThemeByIdAction;
use App\Containers\Constructor\Template\Actions\FindThemeByIdActionInterface;
use App\Containers\Constructor\Template\Actions\GetAllThemesAction;
use App\Containers\Constructor\Template\Actions\GetAllThemesActionInterface;
use App\Containers\Constructor\Template\Actions\UpdateTemplateAction;
use App\Containers\Constructor\Template\Actions\UpdateTemplateActionInterface;
use App\Containers\Constructor\Template\Tasks\ActivateThemeTask;
use App\Containers\Constructor\Template\Tasks\ActivateThemeTaskInterface;
use App\Containers\Constructor\Template\Tasks\CreateTemplateTask;
use App\Containers\Constructor\Template\Tasks\CreateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\CreateThemeTask;
use App\Containers\Constructor\Template\Tasks\CreateThemeTaskInterface;
use App\Containers\Constructor\Template\Tasks\DeleteTemplateTask;
use App\Containers\Constructor\Template\Tasks\DeleteTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\DeleteThemeTask;
use App\Containers\Constructor\Template\Tasks\DeleteThemeTaskInterface;
use App\Containers\Constructor\Template\Tasks\FindTemplateByIdTask;
use App\Containers\Constructor\Template\Tasks\FindTemplateByIdTaskInterface;
use App\Containers\Constructor\Template\Tasks\FindThemeByIdTask;
use App\Containers\Constructor\Template\Tasks\FindThemeByIdTaskInterface;
use App\Containers\Constructor\Template\Tasks\GetAllThemesTask;
use App\Containers\Constructor\Template\Tasks\GetAllThemesTaskInterface;
use App\Containers\Constructor\Template\Tasks\UpdateTemplateTask;
use App\Containers\Constructor\Template\Tasks\UpdateTemplateTaskInterface;
use App\Ship\Parents\Models\Template;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Models\Theme;
use App\Ship\Parents\Models\ThemeInterface;
use App\Ship\Parents\Providers\MainProvider;
use App\Ship\Parents\Repositories\TemplateRepository;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Repositories\ThemeRepository;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;


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
        $this->app->bind(UpdateTemplateActionInterface::class, UpdateTemplateAction::class);

        $this->app->bind(GetAllThemesActionInterface::class, GetAllThemesAction::class);
        $this->app->bind(CreateThemeActionInterface::class, CreateThemeAction::class);
        $this->app->bind(FindThemeByIdActionInterface::class, FindThemeByIdAction::class);
        $this->app->bind(ActivateThemeActionInterface::class, ActivateThemeAction::class);
        $this->app->bind(DeleteThemeActionInterface::class, DeleteThemeAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(CreateTemplateTaskInterface::class, CreateTemplateTask::class);
        $this->app->bind(DeleteTemplateTaskInterface::class, DeleteTemplateTask::class);
        $this->app->bind(FindTemplateByIdTaskInterface::class, FindTemplateByIdTask::class);
        $this->app->bind(UpdateTemplateTaskInterface::class, UpdateTemplateTask::class);

        $this->app->bind(GetAllThemesTaskInterface::class, GetAllThemesTask::class);
        $this->app->bind(CreateThemeTaskInterface::class, CreateThemeTask::class);
        $this->app->bind(FindThemeByIdTaskInterface::class, FindThemeByIdTask::class);
        $this->app->bind(ActivateThemeTaskInterface::class, ActivateThemeTask::class);
        $this->app->bind(DeleteThemeTaskInterface::class, DeleteThemeTask::class);
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

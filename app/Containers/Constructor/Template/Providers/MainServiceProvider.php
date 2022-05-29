<?php

namespace App\Containers\Constructor\Template\Providers;

use App\Containers\Constructor\Template\Actions\GetAllIncludableItemsAction;
use App\Containers\Constructor\Template\Actions\GetAllIncludableItemsActionInterface;
use App\Containers\Constructor\Template\Actions\GetListBaseTemplatesAction;
use App\Containers\Constructor\Template\Actions\GetListBaseTemplatesActionInterface;
use App\Containers\Constructor\Template\Actions\Template\CreateTemplateAction;
use App\Containers\Constructor\Template\Actions\Template\CreateTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\Template\DeleteTemplateAction;
use App\Containers\Constructor\Template\Actions\Template\DeleteTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\Template\FindTemplateByIdAction;
use App\Containers\Constructor\Template\Actions\Template\FindTemplateByIdActionInterface;
use App\Containers\Constructor\Template\Actions\Template\UpdateNameTemplateAction;
use App\Containers\Constructor\Template\Actions\Template\UpdateNameTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\Template\UpdateTemplateAction;
use App\Containers\Constructor\Template\Actions\Template\UpdateTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\ActivateThemeAction;
use App\Containers\Constructor\Template\Actions\Theme\ActivateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\CreateThemeAction;
use App\Containers\Constructor\Template\Actions\Theme\CreateThemeActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\DeleteThemeAction;
use App\Containers\Constructor\Template\Actions\Theme\DeleteThemeActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\FindThemeByIdAction;
use App\Containers\Constructor\Template\Actions\Theme\FindThemeByIdActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\GetAllThemesAction;
use App\Containers\Constructor\Template\Actions\Theme\GetAllThemesActionInterface;
use App\Containers\Constructor\Template\Actions\Theme\UpdateNameThemeAction;
use App\Containers\Constructor\Template\Actions\Theme\UpdateNameThemeActionInterface;
use App\Containers\Constructor\Template\Tasks\GetAllIncludableItemsTask;
use App\Containers\Constructor\Template\Tasks\GetAllIncludableItemsTaskInterface;
use App\Containers\Constructor\Template\Tasks\GetListBaseTemplatesTask;
use App\Containers\Constructor\Template\Tasks\GetListBaseTemplatesTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\CreateTemplateTask;
use App\Containers\Constructor\Template\Tasks\Template\CreateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\DeleteTemplateTask;
use App\Containers\Constructor\Template\Tasks\Template\DeleteTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\FindTemplateByIdTask;
use App\Containers\Constructor\Template\Tasks\Template\FindTemplateByIdTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\GetTemplatesFilepathTask;
use App\Containers\Constructor\Template\Tasks\Template\GetTemplatesFilepathTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\UpdateNameTemplateTask;
use App\Containers\Constructor\Template\Tasks\Template\UpdateNameTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\UpdateTemplateTask;
use App\Containers\Constructor\Template\Tasks\Template\UpdateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\Theme\ActivateThemeTask;
use App\Containers\Constructor\Template\Tasks\Theme\ActivateThemeTaskInterface;
use App\Containers\Constructor\Template\Tasks\Theme\CreateThemeTask;
use App\Containers\Constructor\Template\Tasks\Theme\CreateThemeTaskInterface;
use App\Containers\Constructor\Template\Tasks\Theme\DeleteThemeTask;
use App\Containers\Constructor\Template\Tasks\Theme\DeleteThemeTaskInterface;
use App\Containers\Constructor\Template\Tasks\Theme\FindThemeByIdTask;
use App\Containers\Constructor\Template\Tasks\Theme\FindThemeByIdTaskInterface;
use App\Containers\Constructor\Template\Tasks\Theme\GetAllThemesTask;
use App\Containers\Constructor\Template\Tasks\Theme\GetAllThemesTaskInterface;
use App\Containers\Constructor\Template\Tasks\Theme\UpdateNameThemeTask;
use App\Containers\Constructor\Template\Tasks\Theme\UpdateNameThemeTaskInterface;
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
        $this->app->bind(UpdateNameThemeActionInterface::class, UpdateNameThemeAction::class);
        $this->app->bind(UpdateNameTemplateActionInterface::class, UpdateNameTemplateAction::class);

        $this->app->bind(GetAllThemesActionInterface::class, GetAllThemesAction::class);
        $this->app->bind(GetAllIncludableItemsActionInterface::class, GetAllIncludableItemsAction::class);
        $this->app->bind(GetListBaseTemplatesActionInterface::class, GetListBaseTemplatesAction::class);
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
        $this->app->bind(UpdateNameThemeTaskInterface::class, UpdateNameThemeTask::class);
        $this->app->bind(UpdateNameTemplateTaskInterface::class, UpdateNameTemplateTask::class);

        $this->app->bind(GetAllThemesTaskInterface::class, GetAllThemesTask::class);
        $this->app->bind(GetAllIncludableItemsTaskInterface::class, GetAllIncludableItemsTask::class);
        $this->app->bind(GetListBaseTemplatesTaskInterface::class, GetListBaseTemplatesTask::class);
        $this->app->bind(GetTemplatesFilepathTaskInterface::class, GetTemplatesFilepathTask::class);
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

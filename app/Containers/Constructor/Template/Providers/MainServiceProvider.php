<?php

namespace App\Containers\Constructor\Template\Providers;

use App\Containers\Constructor\Template\Actions\CreateTemplateAction;
use App\Containers\Constructor\Template\Actions\CreateTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\DeleteTemplateAction;
use App\Containers\Constructor\Template\Actions\DeleteTemplateActionInterface;
use App\Containers\Constructor\Template\Actions\FindTemplateByIdAction;
use App\Containers\Constructor\Template\Actions\FindTemplateByIdActionInterface;
use App\Containers\Constructor\Template\Actions\GetAllTemplatesAction;
use App\Containers\Constructor\Template\Actions\GetAllTemplatesActionInterface;
use App\Containers\Constructor\Template\Actions\UpdateTemplateAction;
use App\Containers\Constructor\Template\Actions\UpdateTemplateActionInterface;
use App\Containers\Constructor\Template\Data\Repositories\TemplateRepository;
use App\Containers\Constructor\Template\Data\Repositories\TemplateRepositoryInterface;
use App\Containers\Constructor\Template\Models\Template;
use App\Containers\Constructor\Template\Models\TemplateInterface;
use App\Containers\Constructor\Template\Tasks\CreateTemplateTask;
use App\Containers\Constructor\Template\Tasks\CreateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\DeleteTemplateTask;
use App\Containers\Constructor\Template\Tasks\DeleteTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\FindTemplateByIdTask;
use App\Containers\Constructor\Template\Tasks\FindTemplateByIdTaskInterface;
use App\Containers\Constructor\Template\Tasks\GetAllTemplatesTask;
use App\Containers\Constructor\Template\Tasks\GetAllTemplatesTaskInterface;
use App\Containers\Constructor\Template\Tasks\UpdateTemplateTask;
use App\Containers\Constructor\Template\Tasks\UpdateTemplateTaskInterface;
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
    }

    private function bindTasks(): void
    {
        $this->app->bind(CreateTemplateTaskInterface::class, CreateTemplateTask::class);
        $this->app->bind(DeleteTemplateTaskInterface::class, DeleteTemplateTask::class);
        $this->app->bind(FindTemplateByIdTaskInterface::class, FindTemplateByIdTask::class);
        $this->app->bind(GetAllTemplatesTaskInterface::class, GetAllTemplatesTask::class);
        $this->app->bind(UpdateTemplateTaskInterface::class, UpdateTemplateTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(TemplateRepositoryInterface::class, TemplateRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(TemplateInterface::class, Template::class);
    }
}

<?php

namespace App\Containers\Dashboard\Content\Providers;

use App\Containers\Dashboard\Content\Actions\CreateContentAction;
use App\Containers\Dashboard\Content\Actions\CreateContentActionInterface;
use App\Containers\Dashboard\Content\Actions\DeleteContentAction;
use App\Containers\Dashboard\Content\Actions\DeleteContentActionInterface;
use App\Containers\Dashboard\Content\Actions\FindContentByIdAction;
use App\Containers\Dashboard\Content\Actions\FindContentByIdActionInterface;
use App\Containers\Dashboard\Content\Actions\GetAllContentAction;
use App\Containers\Dashboard\Content\Actions\GetAllContentActionInterface;
use App\Containers\Dashboard\Content\Actions\GetMenuListAction;
use App\Containers\Dashboard\Content\Actions\GetMenuListActionInterface;
use App\Containers\Dashboard\Content\Actions\UpdateContentAction;
use App\Containers\Dashboard\Content\Actions\UpdateContentActionInterface;
use App\Containers\Dashboard\Content\Data\Repositories\ContentRepository;
use App\Containers\Dashboard\Content\Data\Repositories\ContentRepositoryInterface;
use App\Containers\Dashboard\Content\Data\Repositories\ContentValueRepository;
use App\Containers\Dashboard\Content\Data\Repositories\ContentValueRepositoryInterface;
use App\Containers\Dashboard\Content\Models\Content;
use App\Containers\Dashboard\Content\Models\ContentInterface;
use App\Containers\Dashboard\Content\Models\ContentValue;
use App\Containers\Dashboard\Content\Models\ContentValueInterface;
use App\Containers\Dashboard\Content\Tasks\CreateContentSeoLinkTask;
use App\Containers\Dashboard\Content\Tasks\CreateContentSeoLinkTaskInterface;
use App\Containers\Dashboard\Content\Tasks\CreateContentTask;
use App\Containers\Dashboard\Content\Tasks\CreateContentTaskInterface;
use App\Containers\Dashboard\Content\Tasks\DeleteContentTask;
use App\Containers\Dashboard\Content\Tasks\DeleteContentTaskInterface;
use App\Containers\Dashboard\Content\Tasks\FindContentByIdTask;
use App\Containers\Dashboard\Content\Tasks\FindContentByIdTaskInterface;
use App\Containers\Dashboard\Content\Tasks\GetAllContentsTask;
use App\Containers\Dashboard\Content\Tasks\GetAllContentsTaskInterface;
use App\Containers\Dashboard\Content\Tasks\UpdateContentTask;
use App\Containers\Dashboard\Content\Tasks\UpdateContentTaskInterface;
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
        $this->app->bind(FindContentByIdActionInterface::class, FindContentByIdAction::class);
        $this->app->bind(CreateContentActionInterface::class, CreateContentAction::class);
        $this->app->bind(GetAllContentActionInterface::class, GetAllContentAction::class);
        $this->app->bind(UpdateContentActionInterface::class, UpdateContentAction::class);
        $this->app->bind(DeleteContentActionInterface::class, DeleteContentAction::class);
        $this->app->bind(GetMenuListActionInterface::class, GetMenuListAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(FindContentByIdTaskInterface::class, FindContentByIdTask::class);
        $this->app->bind(CreateContentTaskInterface::class, CreateContentTask::class);
        $this->app->bind(CreateContentSeoLinkTaskInterface::class, CreateContentSeoLinkTask::class);
        $this->app->bind(GetAllContentsTaskInterface::class, GetAllContentsTask::class);
        $this->app->bind(UpdateContentTaskInterface::class, UpdateContentTask::class);
        $this->app->bind(DeleteContentTaskInterface::class, DeleteContentTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(ContentValueRepositoryInterface::class, ContentValueRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(ContentInterface::class, Content::class);
        $this->app->bind(ContentValueInterface::class, ContentValue::class);
    }
}

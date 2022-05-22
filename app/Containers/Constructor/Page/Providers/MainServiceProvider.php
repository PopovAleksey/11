<?php

namespace App\Containers\Constructor\Page\Providers;

use App\Containers\Constructor\Page\Actions\ActivatePageAction;
use App\Containers\Constructor\Page\Actions\ActivatePageActionInterface;
use App\Containers\Constructor\Page\Actions\CreatePageAction;
use App\Containers\Constructor\Page\Actions\CreatePageActionInterface;
use App\Containers\Constructor\Page\Actions\DeletePageAction;
use App\Containers\Constructor\Page\Actions\DeletePageActionInterface;
use App\Containers\Constructor\Page\Actions\FindPageByIdAction;
use App\Containers\Constructor\Page\Actions\FindPageByIdActionInterface;
use App\Containers\Constructor\Page\Actions\GetAllPagesAction;
use App\Containers\Constructor\Page\Actions\GetAllPagesActionInterface;
use App\Containers\Constructor\Page\Actions\UpdatePageAction;
use App\Containers\Constructor\Page\Actions\UpdatePageActionInterface;
use App\Containers\Constructor\Page\Tasks\Field\CreateFieldTask;
use App\Containers\Constructor\Page\Tasks\Field\CreateFieldTaskInterface;
use App\Containers\Constructor\Page\Tasks\Field\DeleteFieldTask;
use App\Containers\Constructor\Page\Tasks\Field\DeleteFieldTaskInterface;
use App\Containers\Constructor\Page\Tasks\Field\FindFieldByIdTask;
use App\Containers\Constructor\Page\Tasks\Field\FindFieldByIdTaskInterface;
use App\Containers\Constructor\Page\Tasks\Field\UpdateFieldTask;
use App\Containers\Constructor\Page\Tasks\Field\UpdateFieldTaskInterface;
use App\Containers\Constructor\Page\Tasks\Page\ActivatePageTask;
use App\Containers\Constructor\Page\Tasks\Page\ActivatePageTaskInterface;
use App\Containers\Constructor\Page\Tasks\Page\CreatePageTask;
use App\Containers\Constructor\Page\Tasks\Page\CreatePageTaskInterface;
use App\Containers\Constructor\Page\Tasks\Page\DeletePageTask;
use App\Containers\Constructor\Page\Tasks\Page\DeletePageTaskInterface;
use App\Containers\Constructor\Page\Tasks\Page\FindPageByIdTask;
use App\Containers\Constructor\Page\Tasks\Page\FindPageByIdTaskInterface;
use App\Containers\Constructor\Page\Tasks\Page\GetAllPagesTask;
use App\Containers\Constructor\Page\Tasks\Page\GetAllPagesTaskInterface;
use App\Containers\Constructor\Page\Tasks\Page\UpdatePageTask;
use App\Containers\Constructor\Page\Tasks\Page\UpdatePageTaskInterface;
use App\Ship\Parents\Models\Page;
use App\Ship\Parents\Models\PageField;
use App\Ship\Parents\Models\PageFieldInterface;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Providers\MainProvider;
use App\Ship\Parents\Repositories\PageFieldRepository;
use App\Ship\Parents\Repositories\PageFieldRepositoryInterface;
use App\Ship\Parents\Repositories\PageRepository;
use App\Ship\Parents\Repositories\PageRepositoryInterface;


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
        $this->app->bind(CreatePageActionInterface::class, CreatePageAction::class);
        $this->app->bind(DeletePageActionInterface::class, DeletePageAction::class);
        $this->app->bind(FindPageByIdActionInterface::class, FindPageByIdAction::class);
        $this->app->bind(GetAllPagesActionInterface::class, GetAllPagesAction::class);
        $this->app->bind(UpdatePageActionInterface::class, UpdatePageAction::class);
        $this->app->bind(ActivatePageActionInterface::class, ActivatePageAction::class);
    }

    private function bindTasks(): void
    {
        $this->app->bind(CreatePageTaskInterface::class, CreatePageTask::class);
        $this->app->bind(DeletePageTaskInterface::class, DeletePageTask::class);
        $this->app->bind(FindPageByIdTaskInterface::class, FindPageByIdTask::class);
        $this->app->bind(FindFieldByIdTaskInterface::class, FindFieldByIdTask::class);
        $this->app->bind(GetAllPagesTaskInterface::class, GetAllPagesTask::class);
        $this->app->bind(UpdatePageTaskInterface::class, UpdatePageTask::class);

        $this->app->bind(ActivatePageTaskInterface::class, ActivatePageTask::class);

        $this->app->bind(CreateFieldTaskInterface::class, CreateFieldTask::class);
        $this->app->bind(UpdateFieldTaskInterface::class, UpdateFieldTask::class);
        $this->app->bind(DeleteFieldTaskInterface::class, DeleteFieldTask::class);
    }

    private function bindRepositories(): void
    {
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(PageFieldRepositoryInterface::class, PageFieldRepository::class);
    }

    private function bindModels(): void
    {
        $this->app->bind(PageInterface::class, Page::class);
        $this->app->bind(PageFieldInterface::class, PageField::class);
    }
}

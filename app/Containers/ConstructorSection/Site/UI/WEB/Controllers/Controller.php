<?php

namespace App\Containers\ConstructorSection\Site\UI\WEB\Controllers;

use App\Containers\ConstructorSection\Site\Interfaces\Actions\CreateSiteActionInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Actions\DeleteSiteActionInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Actions\FindSiteByIdActionInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Actions\GetAllSitesActionInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Actions\UpdateSiteActionInterface;
use App\Containers\ConstructorSection\Site\UI\WEB\Requests\CreateSiteRequest;
use App\Containers\ConstructorSection\Site\UI\WEB\Requests\EditSiteRequest;
use App\Containers\ConstructorSection\Site\UI\WEB\Requests\FindSiteByIdRequest;
use App\Containers\ConstructorSection\Site\UI\WEB\Requests\StoreSiteRequest;
use App\Containers\ConstructorSection\Site\UI\WEB\Requests\UpdateSiteRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Controller extends WebController
{
    public function __construct(
        private CreateSiteActionInterface   $createSiteAction,
        private DeleteSiteActionInterface   $deleteSiteAction,
        private GetAllSitesActionInterface  $allSitesAction,
        private UpdateSiteActionInterface   $updateSiteAction,
        private FindSiteByIdActionInterface $findSiteByIdAction
    )
    {
    }

    public function index(): Factory|View|Application
    {
        $sites = $this->allSitesAction->run();

        return view('constructorSection@site::sites-list', $sites);
    }

    public function show(FindSiteByIdRequest $request)
    {
        $site = $this->findSiteByIdAction->run($request);
        dd($site);
        // ..
    }

    public function create(CreateSiteRequest $request)
    {
        $create = $this->createSiteAction->run($request->mapped());
    }

    public function store(StoreSiteRequest $request)
    {
        $site = $this->createSiteAction->run($request->mapped());
    }

    public function edit(EditSiteRequest $request)
    {
        $site = $this->findSiteByIdAction->run($request);
        // ..
    }

    public function update(UpdateSiteRequest $request)
    {
        $site = $this->updateSiteAction->run($request);
    }

    public function destroy(int $id)
    {
        $result = $this->deleteSiteAction->run($id);
    }
}

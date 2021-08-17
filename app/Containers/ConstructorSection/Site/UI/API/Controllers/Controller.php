<?php

namespace App\Containers\ConstructorSection\Site\UI\API\Controllers;

use App\Containers\ConstructorSection\Site\UI\API\Requests\CreateSiteRequest;
use App\Containers\ConstructorSection\Site\UI\API\Requests\DeleteSiteRequest;
use App\Containers\ConstructorSection\Site\UI\API\Requests\GetAllSitesRequest;
use App\Containers\ConstructorSection\Site\UI\API\Requests\FindSiteByIdRequest;
use App\Containers\ConstructorSection\Site\UI\API\Requests\UpdateSiteRequest;
use App\Containers\ConstructorSection\Site\UI\API\Transformers\SiteTransformer;
use App\Containers\ConstructorSection\Site\Actions\CreateSiteAction;
use App\Containers\ConstructorSection\Site\Actions\FindSiteByIdAction;
use App\Containers\ConstructorSection\Site\Actions\GetAllSitesAction;
use App\Containers\ConstructorSection\Site\Actions\UpdateSiteAction;
use App\Containers\ConstructorSection\Site\Actions\DeleteSiteAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function createSite(CreateSiteRequest $request): JsonResponse
    {
        $site = app(CreateSiteAction::class)->run($request);
        return $this->created($this->transform($site, SiteTransformer::class));
    }

    public function findSiteById(FindSiteByIdRequest $request): array
    {
        $site = app(FindSiteByIdAction::class)->run($request);
        return $this->transform($site, SiteTransformer::class);
    }

    public function getAllSites(GetAllSitesRequest $request): array
    {
        $sites = app(GetAllSitesAction::class)->run($request);
        return $this->transform($sites, SiteTransformer::class);
    }

    public function updateSite(UpdateSiteRequest $request): array
    {
        $site = app(UpdateSiteAction::class)->run($request);
        return $this->transform($site, SiteTransformer::class);
    }

    public function deleteSite(DeleteSiteRequest $request): JsonResponse
    {
        app(DeleteSiteAction::class)->run($request);
        return $this->noContent();
    }
}

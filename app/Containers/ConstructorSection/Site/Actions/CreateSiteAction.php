<?php

namespace App\Containers\ConstructorSection\Site\Actions;

use App\Containers\ConstructorSection\Site\DTO\SiteDTO;
use App\Containers\ConstructorSection\Site\Interfaces\Actions\CreateSiteActionInterface;
use App\Containers\ConstructorSection\Site\Tasks\CreateSiteTask;
use App\Ship\Parents\Actions\Action;

class CreateSiteAction extends Action implements CreateSiteActionInterface
{
    public function run(SiteDTO $data): bool
    {

        return app(CreateSiteTask::class)->run($data);
    }
}

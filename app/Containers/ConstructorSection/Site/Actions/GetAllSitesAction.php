<?php

namespace App\Containers\ConstructorSection\Site\Actions;

use App\Containers\ConstructorSection\Site\Interfaces\Actions\GetAllSitesActionInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\GetAllSitesTaskInterface;
use App\Ship\Parents\Actions\Action;

class GetAllSitesAction extends Action implements GetAllSitesActionInterface
{
    public function __construct(private GetAllSitesTaskInterface $allSitesTask)
    {
    }

    public function run()
    {
        return $this->allSitesTask->run();
    }
}

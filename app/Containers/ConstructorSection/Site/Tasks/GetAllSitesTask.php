<?php

namespace App\Containers\ConstructorSection\Site\Tasks;

use App\Containers\ConstructorSection\Site\Interfaces\Repositories\SiteRepositoryInterface;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\GetAllSitesTaskInterface;
use App\Ship\Parents\Tasks\Task;

class GetAllSitesTask extends Task implements GetAllSitesTaskInterface
{
    public function __construct(private SiteRepositoryInterface $repository)
    {
    }

    public function run()
    {

        #dd($this->repository->paginate());
        #dd($this->repository->paginate()->map(fn($data) => dump($data)));
        return $this->repository->paginate();
    }
}

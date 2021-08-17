<?php

namespace App\Containers\ConstructorSection\Site\Tasks;

use App\Containers\ConstructorSection\Site\Data\Repositories\SiteRepository;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\FindSiteByIdTaskInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindSiteByIdTask extends Task implements FindSiteByIdTaskInterface
{
    protected SiteRepository $repository;

    public function __construct(SiteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}

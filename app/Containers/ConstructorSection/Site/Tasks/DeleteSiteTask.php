<?php

namespace App\Containers\ConstructorSection\Site\Tasks;

use App\Containers\ConstructorSection\Site\Data\Repositories\SiteRepository;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\DeleteSiteTaskInterface;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteSiteTask extends Task implements DeleteSiteTaskInterface
{
    protected SiteRepository $repository;

    public function __construct(SiteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id): ?int
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}

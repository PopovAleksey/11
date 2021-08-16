<?php

namespace App\Containers\ConstructorSection\Site\Tasks;

use App\Containers\ConstructorSection\Site\Data\Repositories\SiteRepository;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\CreateSiteTaskInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateSiteTask extends Task implements CreateSiteTaskInterface
{
    protected SiteRepository $repository;

    public function __construct(SiteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}

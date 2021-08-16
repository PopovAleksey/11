<?php

namespace App\Containers\ConstructorSection\Site\Tasks;

use App\Containers\ConstructorSection\Site\Data\Repositories\SiteRepository;
use App\Containers\ConstructorSection\Site\Interfaces\Tasks\UpdateSiteTaskInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateSiteTask extends Task implements UpdateSiteTaskInterface
{
    protected SiteRepository $repository;

    public function __construct(SiteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}

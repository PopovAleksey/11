<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;
use App\Containers\Constructor\Seo\Data\Repositories\SeoRepositoryInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateSeoTask extends Task implements CreateSeoTaskInterface
{
    public function __construct(private SeoRepositoryInterface $repository)
    {
    }

    public function run(SeoDto $data)
    {
        try {
            return $this->repository->create($data->toArray());
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}

interface CreateSeoTaskInterface
{
    public function run(SeoDto $data);
}
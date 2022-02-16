<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;
use App\Containers\Constructor\Seo\Data\Repositories\SeoRepositoryInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindSeoByIdTask extends Task implements FindSeoByIdTaskInterface
{
    public function __construct(private SeoRepositoryInterface $repository)
    {
    }

    public function run(int $id): SeoDto
    {
        try {
            $Seo = $this->repository->find($id);

            return (new SeoDto())
                        ->setId($Seo->id)
                        ->setCreateAt($Seo->created_at)
                        ->setUpdateAt($Seo->updated_at);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}

interface FindSeoByIdTaskInterface
{
    public function run(int $id): SeoDto;
}

<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;
use App\Containers\Constructor\Seo\Data\Repositories\SeoRepositoryInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateSeoTask extends Task implements UpdateSeoTaskInterface
{
    public function __construct(private SeoRepositoryInterface $repository)
    {
    }

    public function run(SeoDto $data): SeoDto
    {
        try {
            $Seo = $this->repository->update($data->toArray(), $data->getId());

            return (new SeoDto())
                        ->setId($Seo->id)
                        ->setCreateAt($Seo->created_at)
                        ->setUpdateAt($Seo->updated_at);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}

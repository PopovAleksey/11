<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Data\Repositories\ContentRepositoryInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateContentTask extends Task implements CreateContentTaskInterface
{
    public function __construct(private ContentRepositoryInterface $repository)
    {
    }

    public function run(ContentDto $data)
    {
        try {
            return $this->repository->create($data->toArray());
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}


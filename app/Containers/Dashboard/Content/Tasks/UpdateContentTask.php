<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Data\Repositories\ContentRepositoryInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateContentTask extends Task implements UpdateContentTaskInterface
{
    public function __construct(private ContentRepositoryInterface $repository)
    {
    }

    public function run(ContentDto $data): ContentDto
    {
        try {
            $Content = $this->repository->update($data->toArray(), $data->getId());

            return (new ContentDto())
                        ->setId($Content->id)
                        ->setCreateAt($Content->created_at)
                        ->setUpdateAt($Content->updated_at);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}

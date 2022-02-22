<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Data\Repositories\ContentRepositoryInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindContentByIdTask extends Task implements FindContentByIdTaskInterface
{
    public function __construct(private ContentRepositoryInterface $repository)
    {
    }

    public function run(int $id): ContentDto
    {
        try {
            $Content = $this->repository->find($id);

            return (new ContentDto())
                        ->setId($Content->id)
                        ->setCreateAt($Content->created_at)
                        ->setUpdateAt($Content->updated_at);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}

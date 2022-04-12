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

    /**
     * @param int $id
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $id): ContentDto
    {
        try {
            /**
             * @var \App\Containers\Dashboard\Content\Models\ContentInterface $content
             */
            $content = $this->repository->find($id);

            return (new ContentDto())
                ->setId($content->id)
                ->setCreateAt($content->created_at)
                ->setUpdateAt($content->updated_at);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}

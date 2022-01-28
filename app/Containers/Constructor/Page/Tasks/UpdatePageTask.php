<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Repositories\PageRepositoryInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdatePageTask extends Task implements UpdatePageTaskInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Constructor\Page\Data\Dto\PageDto $data
     * @return \App\Containers\Constructor\Page\Data\Dto\PageDto
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(PageDto $data): PageDto
    {
        try {
            /**
             * @var \App\Containers\Constructor\Page\Models\PageInterface $page
             */
            $page = $this->repository->update($data->toArray(), $data->getId());

            return (new PageDto())
                ->setId($page->id)
                ->setName($page->name)
                ->setType($page->type)
                ->setActive($page->active)
                ->setCreateAt($page->created_at)
                ->setUpdateAt($page->updated_at);

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}

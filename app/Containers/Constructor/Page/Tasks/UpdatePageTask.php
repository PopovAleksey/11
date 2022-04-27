<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Repositories\PageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdatePageTask extends Task implements UpdatePageTaskInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\PageDto $data
     * @return \App\Ship\Parents\Dto\PageDto
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(PageDto $data): PageDto
    {
        try {
            $insert = $data->toArray();
            unset($insert['fields']);

            /**
             * @var \App\Ship\Parents\Models\PageInterface $page
             */
            $page = $this->repository->update($insert, $data->getId());

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

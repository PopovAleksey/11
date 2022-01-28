<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Repositories\PageRepositoryInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreatePageTask extends Task implements CreatePageTaskInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Constructor\Page\Data\Dto\PageDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(PageDto $data): int
    {
        try {
            /**
             * @var \App\Containers\Constructor\Page\Models\PageInterface $page
             */
            $page = $this->repository->create($data->toArray());

            return $page->id;

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}


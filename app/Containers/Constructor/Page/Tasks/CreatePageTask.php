<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Repositories\PageRepositoryInterface;
use App\Containers\Constructor\Page\Models\PageInterface;
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
     * @TODO Need implement transaction
     */
    public function run(PageDto $data): int
    {
        try {
            /**
             * @var \App\Containers\Constructor\Page\Models\PageInterface $page
             */
            $page = $this->repository->create($data->toArray());

            if ($page->type === PageInterface::BLOG_TYPE) {
                $this->repository->create([
                    'name'           => $page->name . ' [CONTENT]',
                    'parent_page_id' => $page->id,
                    'type'           => PageInterface::SIMPLE_TYPE,
                    'active'         => true,
                ]);
            }

            return $page->id;

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}


<?php

namespace App\Containers\Constructor\Page\Tasks\Page;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Repositories\PageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreatePageTask extends Task implements CreatePageTaskInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\PageDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     * @TODO Need implement transaction
     */
    public function run(PageDto $data): int
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\PageInterface $page
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


<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Repositories\PageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeletePageTask extends Task implements DeletePageTaskInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \App\Ship\Exceptions\DeleteResourceFailedException
     */
    public function run(int $id): ?bool
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\PageInterface $page
             */
            $page = $this->repository->find($id);

            if ($page->parent_page_id !== null) {
                throw new DeleteResourceFailedException('You can\'t delete child page!');
            }

            return $this->repository->delete($id);

        } catch (Exception) {
            throw new DeleteResourceFailedException();
        }
    }
}

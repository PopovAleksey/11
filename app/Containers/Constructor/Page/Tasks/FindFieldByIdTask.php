<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;
use App\Containers\Constructor\Page\Data\Repositories\PageFieldRepositoryInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindFieldByIdTask extends Task implements FindFieldByIdTaskInterface
{
    public function __construct(private PageFieldRepositoryInterface $repository)
    {
    }

    /**
     * @param int $id
     * @return \App\Containers\Constructor\Page\Data\Dto\PageFieldDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $id): PageFieldDto
    {
        try {
            /**
             * @var \App\Containers\Constructor\Page\Models\PageFieldInterface $pageField
             */
            $pageField = $this->repository->find($id);

            return (new PageFieldDto())
                ->setId($pageField->id)
                ->setName($pageField->name)
                ->setPageId($pageField->page_id)
                ->setType($pageField->type)
                ->setActive($pageField->active)
                ->setValues($pageField->values)
                ->setMask($pageField->mask)
                ->setPlaceholder($pageField->placeholder)
                ->setCreateAt($pageField->created_at)
                ->setUpdateAt($pageField->updated_at);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}

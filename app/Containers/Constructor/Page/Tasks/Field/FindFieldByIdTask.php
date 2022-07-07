<?php

namespace App\Containers\Constructor\Page\Tasks\Field;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\PageFieldDto;
use App\Ship\Parents\Repositories\PageFieldRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindFieldByIdTask extends Task implements FindFieldByIdTaskInterface
{
    public function __construct(
        private readonly PageFieldRepositoryInterface $repository
    )
    {
    }

    /**
     * @param int $id
     * @return \App\Ship\Parents\Dto\PageFieldDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $id): PageFieldDto
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\PageFieldInterface $pageField
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

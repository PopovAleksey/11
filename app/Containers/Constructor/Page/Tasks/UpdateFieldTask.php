<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;
use App\Containers\Constructor\Page\Data\Repositories\PageFieldRepositoryInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateFieldTask extends Task implements UpdateFieldTaskInterface
{
    public function __construct(private PageFieldRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Constructor\Page\Data\Dto\PageFieldDto $data
     * @return \App\Containers\Constructor\Page\Data\Dto\PageFieldDto
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(PageFieldDto $data): PageFieldDto
    {
        try {
            $insert           = $data->toArray();
            $insert['values'] = json_encode($data->getValues(), JSON_THROW_ON_ERROR);

            /**
             * @var \App\Containers\Constructor\Page\Models\PageFieldInterface $field
             */
            $field = $this->repository->update($insert, $data->getId());

            return (new PageFieldDto())
                ->setId($field->id)
                ->setName($field->name)
                ->setType($field->type)
                ->setPlaceholder($field->placeholder)
                ->setMask($field->mask)
                ->setValues($field->values)
                ->setActive($field->active)
                ->setCreateAt($field->created_at)
                ->setUpdateAt($field->updated_at);

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}

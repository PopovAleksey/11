<?php

namespace App\Containers\Constructor\Page\Tasks\Field;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\PageFieldDto;
use App\Ship\Parents\Repositories\PageFieldRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateFieldTask extends Task implements UpdateFieldTaskInterface
{
    public function __construct(private PageFieldRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\PageFieldDto $data
     * @return \App\Ship\Parents\Dto\PageFieldDto
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(PageFieldDto $data): PageFieldDto
    {
        try {
            $insert           = $data->toArray();
            $insert['values'] = json_encode($data->getValues(), JSON_THROW_ON_ERROR);

            /**
             * @var \App\Ship\Parents\Models\PageFieldInterface $field
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

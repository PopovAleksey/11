<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;
use App\Containers\Constructor\Page\Data\Repositories\PageFieldRepositoryInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateFieldTask extends Task implements CreateFieldTaskInterface
{
    public function __construct(private PageFieldRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Constructor\Page\Data\Dto\PageFieldDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(PageFieldDto $data): int
    {
        try {
            $insert           = $data->toArray();
            $insert['values'] = json_encode($data->getValues(), JSON_THROW_ON_ERROR);

            /**
             * @var \App\Containers\Constructor\Page\Models\PageFieldInterface $field
             */
            $field = $this->repository->create($insert);

            return $field->id;

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}


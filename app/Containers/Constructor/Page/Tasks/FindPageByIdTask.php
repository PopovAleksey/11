<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Repositories\PageRepositoryInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindPageByIdTask extends Task implements FindPageByIdTaskInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    public function run(int $id): PageDto
    {
        try {
            $Page = $this->repository->find($id);

            return (new PageDto())
                        ->setId($Page->id)
                        ->setCreateAt($Page->created_at)
                        ->setUpdateAt($Page->updated_at);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}

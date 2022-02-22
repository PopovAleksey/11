<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Tasks\FindContentByIdTaskInterface;
use App\Ship\Parents\Actions\Action;

class FindContentByIdAction extends Action implements FindContentByIdActionInterface
{
    public function __construct(
        private FindContentByIdTaskInterface $findContentByIdTask
    )
    {
    }

    public function run(int $id): ContentDto
    {
        return $this->findContentByIdTask->run($id);
    }
}

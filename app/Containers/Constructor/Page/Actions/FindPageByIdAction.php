<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Tasks\FindPageByIdTaskInterface;
use App\Ship\Parents\Actions\Action;

class FindPageByIdAction extends Action implements FindPageByIdActionInterface
{
    public function __construct(
        private FindPageByIdTaskInterface $findPageByIdTask
    )
    {
    }

    public function run(int $id): PageDto
    {
        return $this->findPageByIdTask->run($id);
    }
}

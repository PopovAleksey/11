<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Tasks\UpdatePageTaskInterface;
use App\Ship\Parents\Actions\Action;

class UpdatePageAction extends Action implements UpdatePageActionInterface
{
    public function __construct(
        private UpdatePageTaskInterface $updatePageTask
    )
    {
    }

    public function run(PageDto $data): PageDto
    {
        return $this->updatePageTask->run($data);
    }
}

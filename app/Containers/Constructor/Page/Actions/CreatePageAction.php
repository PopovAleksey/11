<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Tasks\Page\CreatePageTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\PageDto;

class CreatePageAction extends Action implements CreatePageActionInterface
{
    public function __construct(
        private CreatePageTaskInterface $createPageTask
    )
    {
    }

    public function run(PageDto $data): int
    {
        return $this->createPageTask->run($data);
    }
}
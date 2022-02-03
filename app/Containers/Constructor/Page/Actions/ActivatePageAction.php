<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Tasks\ActivatePageTaskInterface;
use App\Ship\Parents\Actions\Action;

class ActivatePageAction extends Action implements ActivatePageActionInterface
{
    public function __construct(
        private ActivatePageTaskInterface $activatePageTask
    )
    {
    }

    /**
     * @param \App\Containers\Constructor\Page\Data\Dto\PageDto $data
     * @return \App\Containers\Constructor\Page\Data\Dto\PageDto
     */
    public function run(PageDto $data): PageDto
    {
        return $this->activatePageTask->run($data);
    }
}

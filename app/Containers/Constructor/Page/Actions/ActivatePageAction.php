<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Tasks\ActivatePageTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\PageDto;

class ActivatePageAction extends Action implements ActivatePageActionInterface
{
    public function __construct(
        private ActivatePageTaskInterface $activatePageTask
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\PageDto $data
     * @return \App\Ship\Parents\Dto\PageDto
     */
    public function run(PageDto $data): PageDto
    {
        return $this->activatePageTask->run($data);
    }
}

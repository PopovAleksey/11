<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Tasks\Page\FindPageByIdTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\PageDto;

class FindPageByIdAction extends Action implements FindPageByIdActionInterface
{
    public function __construct(
        private readonly FindPageByIdTaskInterface $findPageByIdTask
    )
    {
    }

    public function run(int $id, bool $withFields = false): PageDto
    {
        return $this->findPageByIdTask->run($id, $withFields);
    }
}

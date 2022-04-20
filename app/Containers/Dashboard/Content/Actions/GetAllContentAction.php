<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Tasks\GetAllContentsTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllContentAction extends Action implements GetAllContentActionInterface
{
    public function __construct(
        private GetAllContentsTaskInterface $findContentByIdTask
    )
    {
    }

    public function run(int $pageId): Collection
    {
        return $this->findContentByIdTask->run($pageId);
    }
}

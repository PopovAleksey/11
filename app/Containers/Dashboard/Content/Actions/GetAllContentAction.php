<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Tasks\GetAllContentsTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllContentAction extends Action implements GetAllContentActionInterface
{
    public function __construct(
        private readonly GetAllContentsTaskInterface $findContentByIdTask
    )
    {
    }

    public function run(int $pageId, ?int $parentContentId = null): Collection
    {
        return $this->findContentByIdTask->run($pageId, $parentContentId);
    }
}

<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Tasks\CreateContentSeoLinkTaskInterface;
use App\Containers\Dashboard\Content\Tasks\CreateContentTaskInterface;
use App\Ship\Parents\Actions\Action;

class CreateContentAction extends Action implements CreateContentActionInterface
{
    public function __construct(
        private CreateContentTaskInterface        $createContentTask,
        private CreateContentSeoLinkTaskInterface $createContentSeoLinkTask
    )
    {
    }

    public function run(ContentDto $data): int
    {
        #@TODO Need Implement transaction
        $contentId = $this->createContentTask->run($data);

        $data->setId($contentId);

        $this->createContentSeoLinkTask->run($data);

        return $contentId;
    }
}


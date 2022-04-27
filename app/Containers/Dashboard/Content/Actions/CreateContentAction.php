<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Tasks\CreateContentTaskInterface;
use App\Containers\Dashboard\Content\Tasks\UpdateContentSeoLinkTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ContentDto;

class CreateContentAction extends Action implements CreateContentActionInterface
{
    public function __construct(
        private CreateContentTaskInterface        $createContentTask,
        private UpdateContentSeoLinkTaskInterface $updateContentSeoLinkTask
    )
    {
    }

    public function run(ContentDto $data): int
    {
        #@TODO Need Implement transaction
        $contentId = $this->createContentTask->run($data);

        $data->setId($contentId);

        $this->updateContentSeoLinkTask->run($data);

        return $contentId;
    }
}


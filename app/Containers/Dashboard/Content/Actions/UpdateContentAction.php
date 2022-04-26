<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Tasks\UpdateContentSeoLinkTaskInterface;
use App\Containers\Dashboard\Content\Tasks\UpdateContentTaskInterface;
use App\Ship\Parents\Actions\Action;

class UpdateContentAction extends Action implements UpdateContentActionInterface
{
    public function __construct(
        private UpdateContentTaskInterface        $updateContentTask,
        private UpdateContentSeoLinkTaskInterface $updateContentSeoLinkTask
    )
    {
    }

    public function run(ContentDto $data): bool
    {
        $updated = $this->updateContentTask->run($data);

        $this->updateContentSeoLinkTask->run($data);

        return $updated;
    }
}

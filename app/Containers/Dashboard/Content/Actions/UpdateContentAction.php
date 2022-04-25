<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Tasks\UpdateContentSeoTaskInterface;
use App\Ship\Parents\Actions\Action;

class UpdateContentAction extends Action implements UpdateContentActionInterface
{
    public function __construct(
        private UpdateContentSeoTaskInterface $updateContentTask
    )
    {
    }

    public function run(ContentDto $data): bool
    {
        return $this->updateContentTask->run($data);
    }
}

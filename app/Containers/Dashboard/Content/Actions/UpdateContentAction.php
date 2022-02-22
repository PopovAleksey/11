<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Tasks\UpdateContentTaskInterface;
use App\Ship\Parents\Actions\Action;

class UpdateContentAction extends Action implements UpdateContentActionInterface
{
    public function __construct(
        private UpdateContentTaskInterface $updateContentTask
    )
    {
    }

    public function run(ContentDto $data): ContentDto
    {
        return $this->updateContentTask->run($data);
    }
}

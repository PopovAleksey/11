<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Tasks\CreateContentTaskInterface;
use App\Ship\Parents\Actions\Action;

class CreateContentAction extends Action implements CreateContentActionInterface
{
    public function __construct(
        private CreateContentTaskInterface $createContentTask
    )
    {
    }

    public function run(ContentDto $data): bool
    {
        return $this->createContentTask->run($data);
    }
}


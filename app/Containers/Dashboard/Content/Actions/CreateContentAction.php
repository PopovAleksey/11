<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Tasks\CreateContentTaskInterface;
use App\Containers\Dashboard\Content\Tasks\UpdateContentSeoLinkTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ContentDto;
use Illuminate\Support\Facades\DB;

class CreateContentAction extends Action implements CreateContentActionInterface
{
    public function __construct(
        private readonly CreateContentTaskInterface        $createContentTask,
        private readonly UpdateContentSeoLinkTaskInterface $updateContentSeoLinkTask
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ContentDto $data
     * @return int
     * @throws \Throwable
     */
    public function run(ContentDto $data): int
    {
        return DB::transaction(function () use ($data) {
            $contentId = $this->createContentTask->run($data);

            $data->setId($contentId);

            $this->updateContentSeoLinkTask->run($data);

            return $contentId;
        });
    }
}


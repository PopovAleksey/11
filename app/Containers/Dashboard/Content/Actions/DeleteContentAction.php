<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Containers\Dashboard\Content\Tasks\DeleteContentTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteContentAction extends Action implements DeleteContentActionInterface
{
    public function __construct(
        private readonly DeleteContentTaskInterface $deleteContentTask,
        private readonly ForgetCacheActionInterface $forgetCacheAction
    )
    {
    }

    public function run(int $id): void
    {
        $this->deleteContentTask->run($id);
        # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
        $this->forgetCacheAction->run((new CacheDto()));
    }
}


<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Containers\Dashboard\Content\Tasks\UpdateContentSeoLinkTaskInterface;
use App\Containers\Dashboard\Content\Tasks\UpdateContentTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ContentDto;
use Illuminate\Support\Facades\DB;

class UpdateContentAction extends Action implements UpdateContentActionInterface
{
    public function __construct(
        private UpdateContentTaskInterface        $updateContentTask,
        private UpdateContentSeoLinkTaskInterface $updateContentSeoLinkTask,
        private ForgetCacheActionInterface        $forgetCacheAction
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ContentDto $data
     * @return void
     * @throws \Throwable
     */
    public function run(ContentDto $data): void
    {
        DB::transaction(function () use ($data) {
            $this->updateContentTask->run($data);
            $this->updateContentSeoLinkTask->run($data);
            # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
            $this->forgetCacheAction->run((new CacheDto()));
        });
    }
}

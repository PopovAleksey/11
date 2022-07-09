<?php

namespace App\Containers\Constructor\Template\Actions\Template;

use App\Containers\Constructor\Template\Tasks\Template\DeleteTemplateTaskInterface;
use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Ship\Parents\Actions\Action;

class DeleteTemplateAction extends Action implements DeleteTemplateActionInterface
{
    public function __construct(
        private readonly DeleteTemplateTaskInterface $deleteTemplateTask,
        private readonly ForgetCacheActionInterface  $forgetCacheAction
    )
    {
    }

    public function run(int $id): void
    {
        $this->deleteTemplateTask->run($id);
        # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
        $this->forgetCacheAction->run((new CacheDto()));
    }
}


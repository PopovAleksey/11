<?php

namespace App\Containers\Constructor\Template\Actions\Template;

use App\Containers\Constructor\Template\Tasks\Template\CreateTemplateTaskInterface;
use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;

class CreateTemplateAction extends Action implements CreateTemplateActionInterface
{
    public function __construct(
        private readonly CreateTemplateTaskInterface $createTemplateTask,
        private readonly ForgetCacheActionInterface  $forgetCacheAction
    )
    {
    }

    public function run(TemplateDto $data): int
    {
        # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
        $this->forgetCacheAction->run((new CacheDto()));

        return $this->createTemplateTask->run($data);
    }
}


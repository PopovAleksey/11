<?php

namespace App\Containers\Constructor\Template\Actions\Template;


use App\Containers\Constructor\Template\Tasks\Template\UpdateNameTemplateTaskInterface;
use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;

class UpdateNameTemplateAction extends Action implements UpdateNameTemplateActionInterface
{
    public function __construct(
        private readonly UpdateNameTemplateTaskInterface $updateTemplateTask,
        private readonly ForgetCacheActionInterface      $forgetCacheAction
    )
    {
    }

    public function run(TemplateDto $data): void
    {
        $this->updateTemplateTask->run($data);
        # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
        $this->forgetCacheAction->run((new CacheDto()));
    }
}

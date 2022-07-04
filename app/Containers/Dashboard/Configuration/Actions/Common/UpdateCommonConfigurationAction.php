<?php

namespace App\Containers\Dashboard\Configuration\Actions\Common;

use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Containers\Dashboard\Configuration\Tasks\Common\UpdateCommonConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationCommonDto;

class UpdateCommonConfigurationAction extends Action implements UpdateCommonConfigurationActionInterface
{
    public function __construct(
        private readonly UpdateCommonConfigurationTaskInterface $updateConfigurationTask,
        private readonly ForgetCacheActionInterface             $forgetCacheAction
    )
    {
    }

    public function run(ConfigurationCommonDto $data): void
    {
        $this->updateConfigurationTask->run($data);
        # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
        $this->forgetCacheAction->run((new CacheDto()));
    }
}

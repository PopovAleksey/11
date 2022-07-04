<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Containers\Dashboard\Configuration\Tasks\Menu\UpdateMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationMenuDto;

class UpdateMenuConfigurationAction extends Action implements UpdateMenuConfigurationActionInterface
{
    public function __construct(
        private readonly UpdateMenuConfigurationTaskInterface $updateConfigurationMenuTask,
        private readonly ForgetCacheActionInterface           $forgetCacheAction
    )
    {
    }

    public function run(ConfigurationMenuDto $data): void
    {
        $this->updateConfigurationMenuTask->run($data);
        # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
        $this->forgetCacheAction->run((new CacheDto()));
    }
}

<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Containers\Dashboard\Configuration\Tasks\Menu\ActivateMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationMenuDto;

class ActivateMenuConfigurationAction extends Action implements ActivateMenuConfigurationActionInterface
{
    public function __construct(
        private readonly ActivateMenuConfigurationTaskInterface $activateMenuConfigurationTask,
        private readonly ForgetCacheActionInterface             $forgetCacheAction
    )
    {
    }

    public function run(ConfigurationMenuDto $data): void
    {
        $this->activateMenuConfigurationTask->run($data);
        # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
        $this->forgetCacheAction->run((new CacheDto()));
    }
}

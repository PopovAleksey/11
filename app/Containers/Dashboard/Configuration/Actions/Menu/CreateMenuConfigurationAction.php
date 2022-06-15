<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Containers\Dashboard\Configuration\Tasks\Menu\CreateMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationMenuDto;

class CreateMenuConfigurationAction extends Action implements CreateMenuConfigurationActionInterface
{
    public function __construct(
        private CreateMenuConfigurationTaskInterface $createConfigurationTask,
        private ForgetCacheActionInterface           $forgetCacheAction
    )
    {
    }

    public function run(ConfigurationMenuDto $data): int
    {
        # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
        $this->forgetCacheAction->run((new CacheDto()));

        return $this->createConfigurationTask->run($data);
    }
}


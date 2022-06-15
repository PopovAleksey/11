<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Containers\Dashboard\Configuration\Tasks\Menu\DeleteMenuConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteMenuConfigurationAction extends Action implements DeleteMenuConfigurationActionInterface
{
    public function __construct(
        private DeleteMenuConfigurationTaskInterface $deleteConfigurationTask,
        private ForgetCacheActionInterface           $forgetCacheAction
    )
    {
    }

    public function run(int $id): void
    {
        $this->deleteConfigurationTask->run($id);
        # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
        $this->forgetCacheAction->run((new CacheDto()));
    }
}


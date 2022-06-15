<?php

namespace App\Containers\Core\Cacher\Actions;

use App\Containers\Core\Cacher\Tasks\CacheTaskInterface;
use App\Ship\Parents\Actions\Action;

class CacheAction extends Action implements CacheActionInterface
{
    public function __construct(
        private CacheTaskInterface $createCacherTask
    )
    {
    }

    public function run(): bool
    {
        return $this->createCacherTask->run();
    }
}


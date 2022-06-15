<?php

namespace App\Containers\Core\Cacher\Actions;

use App\Containers\Core\Cacher\Data\Dto\CacheDto;

interface ForgetCacheActionInterface
{
    public function run(CacheDto $cacheDto): bool;
}
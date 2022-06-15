<?php

namespace App\Containers\Core\Cacher\Tasks;

use App\Containers\Core\Cacher\Data\Dto\CacheDto;

interface CreateCacheTaskInterface
{
    public function run(CacheDto $cacheDto): bool;
}
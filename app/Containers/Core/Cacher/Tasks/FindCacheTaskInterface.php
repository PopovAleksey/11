<?php

namespace App\Containers\Core\Cacher\Tasks;


use App\Containers\Core\Cacher\Data\Dto\CacheDto;

interface FindCacheTaskInterface
{
    /**
     * @param \App\Containers\Core\Cacher\Data\Dto\CacheDto $cacheDto
     * @return string
     * @throws \App\Ship\Exceptions\NotFoundException
     * @throws \App\Ship\Exceptions\ValidationFailedException
     */
    public function run(CacheDto $cacheDto): string;
}
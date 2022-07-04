<?php

namespace App\Containers\Core\Cacher\Tasks;

use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Cache;

class FindCacheTask extends Task implements FindCacheTaskInterface
{
    /**
     * @param \App\Containers\Core\Cacher\Data\Dto\CacheDto $cacheDto
     * @return string
     * @throws \App\Ship\Exceptions\NotFoundException
     * @throws \App\Ship\Exceptions\ValidationFailedException
     */
    public function run(CacheDto $cacheDto): string
    {
        $languagePoint = $cacheDto->getLanguage() ?? throw new ValidationFailedException('Language point can\'t be NULL!');
        $contentPoint  = $cacheDto->getSeoLink() ?? $cacheDto->getContentId() ?? 'index';

        $point = implode('_', [$languagePoint, $contentPoint]);

        return Cache::get($point) ?? throw new NotFoundException('Cache not found!');
    }
}


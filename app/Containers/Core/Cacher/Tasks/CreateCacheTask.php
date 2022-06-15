<?php

namespace App\Containers\Core\Cacher\Tasks;

use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Parents\Tasks\Task;
use Cache;

class CreateCacheTask extends Task implements CreateCacheTaskInterface
{
    /**
     * @param \App\Containers\Core\Cacher\Data\Dto\CacheDto $cacheDto
     * @return bool
     * @throws \App\Ship\Exceptions\ValidationFailedException
     */
    public function run(CacheDto $cacheDto): bool
    {
        $languagePoint    = $cacheDto->getLanguage() ?? throw new ValidationFailedException('Language point can\'t be NULL!');
        $data             = $cacheDto->getData() ?? throw new ValidationFailedException('Data can\'t be NULL');
        $pointByContentId = implode('_', [$languagePoint, $cacheDto->getContentId()]);
        $pointBySeoLink   = implode('_', [$languagePoint, $cacheDto->getSeoLink()]);

        return Cache::put($pointBySeoLink, $data) && Cache::put($pointByContentId, $data);
    }
}


<?php

namespace App\Containers\Core\Cacher\Actions;

use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Ship\Parents\Actions\Action;
use Cache;

class ForgetCacheAction extends Action implements ForgetCacheActionInterface
{
    public function run(CacheDto $cacheDto): bool
    {
        if (
            $cacheDto->getLanguage() === null &&
            (
                $cacheDto->getContentId() === null ||
                $cacheDto->getSeoLink() === null
            )
        ) {
            return Cache::flush();
        }

        $languagePoint    = $cacheDto->getLanguage();
        $pointByContentId = implode('_', [$languagePoint, $cacheDto->getContentId()]);
        $pointBySeoLink   = implode('_', [$languagePoint, $cacheDto->getSeoLink()]);

        return Cache::forget($pointBySeoLink) && Cache::forget($pointByContentId);
    }
}

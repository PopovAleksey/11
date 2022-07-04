<?php

namespace App\Containers\Core\Cacher\Actions;

use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Containers\Core\Cacher\Tasks\CreateCacheTaskInterface;
use App\Containers\Core\Cacher\Tasks\FindCacheTaskInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use Exception;

class CacheAction extends Action implements CacheActionInterface
{
    public function __construct(
        private readonly FindCacheTaskInterface   $findCacheTask,
        private readonly CreateCacheTaskInterface $createCacheTask
    )
    {
    }

    /**
     * @TODO Need implement Cacher with tags after migrate cache type from file to memcached/redis as files cache doesn't support tags
     * @param \App\Containers\Core\Cacher\Data\Dto\CacheDto $cacheDto
     * @param callable                                      $data
     * @return string
     */
    public function run(CacheDto $cacheDto, callable $data): string
    {
        try {
            return $this->findCacheTask->run($cacheDto);
        } catch (NotFoundException) {
            $cacheDto->setData($data());
            $this->createCacheTask->run($cacheDto);

            return $cacheDto->getData();
        } catch (Exception) {

            return $data();
        }
    }
}


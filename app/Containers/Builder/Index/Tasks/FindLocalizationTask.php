<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Repositories\LocalizationRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Collection;

class FindLocalizationTask extends Task implements FindLocalizationTaskInterface
{
    public function __construct(
        private readonly LocalizationRepositoryInterface $repository
    )
    {
    }

    /**
     * @param \Illuminate\Support\Collection $localizationPoints
     * @return \Illuminate\Support\Collection
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(Collection $localizationPoints): Collection
    {
        try {
            return collect();

        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}

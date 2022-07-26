<?php

namespace App\Containers\Constructor\Localization\Tasks;

use App\Ship\Parents\Repositories\LocalizationRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class IsPointExistsTask extends Task implements IsPointExistsTaskInterface
{
    public function __construct(
        private readonly LocalizationRepositoryInterface $repository
    )
    {
    }

    public function run(string $point, ?int $themeId = null, ?int $pointId = null): bool
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\LocalizationInterface $point
             */
            $point = $this->repository->findWhere([
                'point'    => $point,
                'theme_id' => $themeId,
            ])->first();

            if ($pointId === null) {
                return $point !== null;
            }

            return $point !== null && $point->id !== $pointId;

        } catch (Exception) {
            return false;
        }
    }
}

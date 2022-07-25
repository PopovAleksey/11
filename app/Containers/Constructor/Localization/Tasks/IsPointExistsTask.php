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

    public function run(string $point, ?int $themeId = null): bool
    {
        try {
            $point = $this->repository->findWhere([
                'point'    => $point,
                'theme_id' => $themeId,
            ])->first();

            return $point !== null;

        } catch (Exception) {
            return false;
        }
    }
}

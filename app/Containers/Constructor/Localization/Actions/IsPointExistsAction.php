<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Containers\Constructor\Localization\Tasks\IsPointExistsTaskInterface;
use App\Ship\Parents\Actions\Action;

class IsPointExistsAction extends Action implements IsPointExistsActionInterface
{
    public function __construct(
        private readonly IsPointExistsTaskInterface $isPointExistsTask
    )
    {
    }

    public function run(string $point, ?int $themeId = null): bool
    {
        return $this->isPointExistsTask->run($point, $themeId);
    }
}

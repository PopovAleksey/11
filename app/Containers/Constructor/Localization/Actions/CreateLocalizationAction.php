<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Containers\Constructor\Localization\Tasks\CreateLocalizationTaskInterface;
use App\Containers\Constructor\Localization\Tasks\IsPointExistsTaskInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\LocalizationDto;

class CreateLocalizationAction extends Action implements CreateLocalizationActionInterface
{
    public function __construct(
        private readonly CreateLocalizationTaskInterface $createLocalizationTask,
        private readonly IsPointExistsTaskInterface      $isPointExistsTask
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\LocalizationDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(LocalizationDto $data): int
    {
        if ($this->isPointExistsTask->run($data->getPoint(), $data->getThemeId()) === true) {
            throw new CreateResourceFailedException('Point is exists!');
        }

        return $this->createLocalizationTask->run($data);
    }
}
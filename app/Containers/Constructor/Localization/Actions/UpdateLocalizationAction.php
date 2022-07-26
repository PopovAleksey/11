<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Containers\Constructor\Localization\Tasks\IsPointExistsTaskInterface;
use App\Containers\Constructor\Localization\Tasks\UpdateLocalizationTaskInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\LocalizationDto;

class UpdateLocalizationAction extends Action implements UpdateLocalizationActionInterface
{
    public function __construct(
        private readonly UpdateLocalizationTaskInterface $updateLocalizationTask,
        private readonly IsPointExistsTaskInterface      $isPointExistsTask
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\LocalizationDto $data
     * @return void
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(LocalizationDto $data): void
    {
        if ($this->isPointExistsTask->run($data->getPoint(), $data->getThemeId(), $data->getId()) === true) {
            throw new CreateResourceFailedException('Point is exists!');
        }

        $this->updateLocalizationTask->run($data);
    }
}

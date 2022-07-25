<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Containers\Constructor\Localization\Tasks\CreateLocalizationTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\LocalizationDto;

class CreateLocalizationAction extends Action implements CreateLocalizationActionInterface
{
    public function __construct(
        private readonly CreateLocalizationTaskInterface $createLocalizationTask
    )
    {
    }

    public function run(LocalizationDto $data): int
    {
        return $this->createLocalizationTask->run($data);
    }
}
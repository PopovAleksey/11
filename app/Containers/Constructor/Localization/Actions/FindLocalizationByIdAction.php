<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Containers\Constructor\Localization\Tasks\FindLocalizationByIdTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\LocalizationDto;

class FindLocalizationByIdAction extends Action implements FindLocalizationByIdActionInterface
{
    public function __construct(
        private FindLocalizationByIdTaskInterface $findLocalizationByIdTask
    )
    {
    }

    public function run(int $id): LocalizationDto
    {
        return $this->findLocalizationByIdTask->run($id);
    }
}

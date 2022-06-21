<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Containers\Constructor\Localization\Tasks\GetAllLocalizationsTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllLocalizationsAction extends Action implements GetAllLocalizationsActionInterface
{
    public function __construct(
        private GetAllLocalizationsTaskInterface $getAllLocalizationTask
    )
    {
    }

    public function run(): Collection
    {
        return $this->getAllLocalizationTask->run();
    }
}

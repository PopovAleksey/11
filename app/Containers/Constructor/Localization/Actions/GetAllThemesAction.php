<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Containers\Constructor\Localization\Tasks\GetAllThemesTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllThemesAction extends Action implements GetAllThemesActionInterface
{
    public function __construct(
        private GetAllThemesTaskInterface $getAllThemeTask
    )
    {
    }

    public function run(): Collection
    {
        return $this->getAllThemeTask->run();
    }
}

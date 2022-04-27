<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Tasks\ActivateThemeTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ThemeDto;

class ActivateThemeAction extends Action implements ActivateThemeActionInterface
{
    public function __construct(
        private ActivateThemeTaskInterface $activateThemeTask
    )
    {
    }

    public function run(ThemeDto $data): ThemeDto
    {
        return $this->activateThemeTask->run($data);
    }
}

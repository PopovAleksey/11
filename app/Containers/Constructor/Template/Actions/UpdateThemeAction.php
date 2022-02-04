<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Tasks\UpdateThemeTaskInterface;
use App\Ship\Parents\Actions\Action;

class UpdateThemeAction extends Action implements UpdateThemeActionInterface
{
    public function __construct(
        private UpdateThemeTaskInterface $updateThemeTask
    )
    {
    }

    public function run(ThemeDto $data): ThemeDto
    {
        return $this->updateThemeTask->run($data);
    }
}

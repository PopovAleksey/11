<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Tasks\CreateThemeTaskInterface;
use App\Ship\Parents\Actions\Action;

class CreateThemeAction extends Action implements CreateThemeActionInterface
{
    public function __construct(
        private CreateThemeTaskInterface $createThemeTask
    )
    {
    }

    public function run(ThemeDto $data): bool
    {
        return $this->createThemeTask->run($data);
    }
}


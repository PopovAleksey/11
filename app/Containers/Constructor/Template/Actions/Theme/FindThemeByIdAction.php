<?php

namespace App\Containers\Constructor\Template\Actions\Theme;

use App\Containers\Constructor\Template\Tasks\Theme\FindThemeByIdTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ThemeDto;

class FindThemeByIdAction extends Action implements FindThemeByIdActionInterface
{
    public function __construct(
        private FindThemeByIdTaskInterface $findThemeByIdTask
    )
    {
    }

    public function run(int $id): ThemeDto
    {
        return $this->findThemeByIdTask->run($id);
    }
}

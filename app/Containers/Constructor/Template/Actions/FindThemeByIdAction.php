<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constuctor\Template\Tasks\FindThemeByIdTaskInterface;
use App\Ship\Parents\Actions\Action;

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

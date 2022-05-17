<?php

namespace App\Containers\Constructor\Template\Actions\Theme;

use App\Containers\Constructor\Template\Tasks\Theme\UpdateNameThemeTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ThemeDto;

class UpdateNameThemeAction extends Action implements UpdateNameThemeActionInterface
{
    public function __construct(
        private UpdateNameThemeTaskInterface $updateTemplatesTask
    )
    {
    }

    public function run(ThemeDto $data): bool
    {
        return $this->updateTemplatesTask->run($data);
    }
}

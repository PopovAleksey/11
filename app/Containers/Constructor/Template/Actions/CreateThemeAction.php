<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Models\TemplateInterface;
use App\Containers\Constructor\Template\Tasks\CreateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\CreateThemeTaskInterface;
use App\Ship\Parents\Actions\Action;

class CreateThemeAction extends Action implements CreateThemeActionInterface
{
    public function __construct(
        private CreateThemeTaskInterface    $createThemeTask,
        private CreateTemplateTaskInterface $createTemplateTask
    )
    {
    }

    public function run(ThemeDto $data): int
    {
        $theme = $this->createThemeTask->run($data);

        collect([
            TemplateInterface::BASE_TYPE,
            TemplateInterface::JS_TYPE,
            TemplateInterface::CSS_TYPE,
        ])
            ->each(function (string $templateType) use ($theme) {
                $templateDto = (new TemplateDto())
                    ->setType($templateType)
                    ->setTheme($theme);

                $this->createTemplateTask->run($templateDto);
            });

        return $theme->getId();
    }
}


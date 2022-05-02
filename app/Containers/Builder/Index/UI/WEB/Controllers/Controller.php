<?php

namespace App\Containers\Builder\Index\UI\WEB\Controllers;

use App\Containers\Builder\Index\Actions\BuildTemplateActionInterface;
use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
    public function __construct(
        private BuildTemplateActionInterface $buildTemplateAction
    )
    {
    }

    public function index(?string $language = null, ?string $seoLink = null): string
    {
        return $this->buildTemplateAction->run($language, $seoLink);
    }
}

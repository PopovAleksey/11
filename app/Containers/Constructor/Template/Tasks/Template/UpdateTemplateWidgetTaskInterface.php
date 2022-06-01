<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

use App\Ship\Parents\Dto\TemplateWidgetDto;

interface UpdateTemplateWidgetTaskInterface
{
    public function run(TemplateWidgetDto $data): void;
}
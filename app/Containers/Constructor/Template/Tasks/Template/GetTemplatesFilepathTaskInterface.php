<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Models\ThemeInterface;

interface GetTemplatesFilepathTaskInterface
{
    public function run(TemplateInterface $template, ?ThemeInterface $theme = null): array;
}
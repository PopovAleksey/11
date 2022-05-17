<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

use App\Ship\Parents\Dto\TemplateDto;

interface UpdateTemplateTaskInterface
{
    public function run(TemplateDto $data): TemplateDto;
}
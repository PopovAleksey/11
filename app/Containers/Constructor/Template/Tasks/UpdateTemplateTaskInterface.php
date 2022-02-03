<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;

interface UpdateTemplateTaskInterface
{
    public function run(TemplateDto $data): TemplateDto;
}
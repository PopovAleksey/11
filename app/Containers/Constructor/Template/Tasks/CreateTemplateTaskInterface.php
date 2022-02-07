<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;

interface CreateTemplateTaskInterface
{
    public function run(TemplateDto $data): int;
}
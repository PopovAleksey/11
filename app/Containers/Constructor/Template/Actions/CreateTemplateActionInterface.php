<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;

interface CreateTemplateActionInterface
{
    public function run(TemplateDto $data): int;
}
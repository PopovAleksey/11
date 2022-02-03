<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;

interface UpdateTemplateActionInterface
{
    public function run(TemplateDto $data): TemplateDto;
}
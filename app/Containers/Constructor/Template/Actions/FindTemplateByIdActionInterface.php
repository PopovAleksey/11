<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;

interface FindTemplateByIdActionInterface
{
    public function run(int $id): TemplateDto;
}
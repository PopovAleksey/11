<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;

interface FindTemplateByIdTaskInterface
{
    public function run(int $id): TemplateDto;
}
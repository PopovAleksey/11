<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

use App\Ship\Parents\Dto\TemplateDto;

interface FindTemplateByIdTaskInterface
{
    public function run(int $id): TemplateDto;
}
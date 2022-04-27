<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Parents\Dto\TemplateDto;

interface FindTemplateByIdTaskInterface
{
    public function run(int $id): TemplateDto;
}
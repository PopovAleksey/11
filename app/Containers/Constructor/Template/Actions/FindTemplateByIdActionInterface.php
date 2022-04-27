<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Ship\Parents\Dto\TemplateDto;

interface FindTemplateByIdActionInterface
{
    public function run(int $id): TemplateDto;
}
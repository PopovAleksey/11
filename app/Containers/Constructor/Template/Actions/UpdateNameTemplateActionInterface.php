<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Ship\Parents\Dto\TemplateDto;

interface UpdateNameTemplateActionInterface
{
    public function run(TemplateDto $data): TemplateDto;
}
<?php

namespace App\Containers\Constructor\Template\Actions\Template;

use App\Ship\Parents\Dto\TemplateDto;

interface UpdateTemplateActionInterface
{
    public function run(TemplateDto $data): TemplateDto;
}
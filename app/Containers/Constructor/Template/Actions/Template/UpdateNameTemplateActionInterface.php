<?php

namespace App\Containers\Constructor\Template\Actions\Template;

use App\Ship\Parents\Dto\TemplateDto;

interface UpdateNameTemplateActionInterface
{
    public function run(TemplateDto $data): void;
}
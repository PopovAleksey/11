<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Ship\Parents\Dto\TemplateDto;

interface CreateTemplateActionInterface
{
    public function run(TemplateDto $data): int;
}
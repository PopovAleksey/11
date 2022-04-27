<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Parents\Dto\TemplateDto;

interface UpdateTemplateTaskInterface
{
    public function run(TemplateDto $data): TemplateDto;
}
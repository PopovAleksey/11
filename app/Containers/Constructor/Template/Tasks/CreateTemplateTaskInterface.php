<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Parents\Dto\TemplateDto;

interface CreateTemplateTaskInterface
{
    public function run(TemplateDto $data): int;
}
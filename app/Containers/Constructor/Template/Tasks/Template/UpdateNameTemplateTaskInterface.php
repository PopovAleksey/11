<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

use App\Ship\Parents\Dto\TemplateDto;

interface UpdateNameTemplateTaskInterface
{
    public function run(TemplateDto $data): void;
}
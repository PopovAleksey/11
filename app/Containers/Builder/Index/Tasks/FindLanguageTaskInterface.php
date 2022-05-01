<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Parents\Dto\LanguageDto;

interface FindLanguageTaskInterface
{
    public function run(?string $shortLangName = null): LanguageDto;
}
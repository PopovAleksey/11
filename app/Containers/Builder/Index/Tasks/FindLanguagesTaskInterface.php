<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Parents\Dto\LanguageDto;

interface FindLanguagesTaskInterface
{
    public function run(?string $shortLangName = null): LanguageDto;
}
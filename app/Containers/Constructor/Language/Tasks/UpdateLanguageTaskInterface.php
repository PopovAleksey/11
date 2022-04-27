<?php

namespace App\Containers\Constructor\Language\Tasks;

use App\Ship\Parents\Dto\LanguageDto;

interface UpdateLanguageTaskInterface
{
    public function run(LanguageDto $data): mixed;
}

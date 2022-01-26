<?php

namespace App\Containers\Constructor\Language\Tasks;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;

interface UpdateLanguageTaskInterface
{
    public function run(LanguageDto $data): mixed;
}

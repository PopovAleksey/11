<?php

namespace App\Containers\Constructor\Language\Tasks;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;

interface CreateLanguageTaskInterface
{
    public function run(LanguageDto $data);
}

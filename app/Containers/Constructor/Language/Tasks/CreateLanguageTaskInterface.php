<?php

namespace App\Containers\Constructor\Language\Tasks;

use App\Ship\Parents\Dto\LanguageDto;

interface CreateLanguageTaskInterface
{
    public function run(LanguageDto $data);
}

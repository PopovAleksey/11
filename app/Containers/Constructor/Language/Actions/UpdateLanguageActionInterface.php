<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;

interface UpdateLanguageActionInterface
{
    public function run(LanguageDto $data): bool;
}

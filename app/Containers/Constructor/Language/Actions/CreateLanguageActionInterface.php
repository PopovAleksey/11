<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;

interface CreateLanguageActionInterface
{
    public function run(LanguageDto $data): bool;
}
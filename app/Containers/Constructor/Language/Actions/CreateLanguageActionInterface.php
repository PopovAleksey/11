<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Ship\Parents\Dto\LanguageDto;

interface CreateLanguageActionInterface
{
    public function run(LanguageDto $data): bool;
}
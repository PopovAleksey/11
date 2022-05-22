<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Ship\Parents\Dto\LanguageDto;

interface UpdateLanguageActionInterface
{
    public function run(LanguageDto $data): void;
}

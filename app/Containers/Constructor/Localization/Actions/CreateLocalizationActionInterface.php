<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Ship\Parents\Dto\LocalizationDto;

interface CreateLocalizationActionInterface
{
    public function run(LocalizationDto $data): int;
}
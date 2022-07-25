<?php

namespace App\Containers\Constructor\Localization\Tasks;

use App\Ship\Parents\Dto\LocalizationDto;

interface CreateLocalizationTaskInterface
{
    public function run(LocalizationDto $localizationDto): int;
}
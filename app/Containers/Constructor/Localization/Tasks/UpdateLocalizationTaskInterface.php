<?php

namespace App\Containers\Constructor\Localization\Tasks;

use App\Ship\Parents\Dto\LocalizationDto;

interface UpdateLocalizationTaskInterface
{
    public function run(LocalizationDto $localizationDto): void;
}
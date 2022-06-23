<?php

namespace App\Containers\Constructor\Localization\Tasks;

use App\Ship\Parents\Dto\LocalizationDto;

interface FindLocalizationByIdTaskInterface
{
    public function run(int $id): LocalizationDto;
}
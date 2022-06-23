<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Ship\Parents\Dto\LocalizationDto;

interface FindLocalizationByIdActionInterface
{
    public function run(int $id): LocalizationDto;
}
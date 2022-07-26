<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Ship\Parents\Dto\LocalizationDto;

interface UpdateLocalizationActionInterface
{
    public function run(LocalizationDto $data): void;
}
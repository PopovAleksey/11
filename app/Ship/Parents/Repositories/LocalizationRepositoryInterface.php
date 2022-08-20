<?php

namespace App\Ship\Parents\Repositories;

use Illuminate\Support\Collection;

interface LocalizationRepositoryInterface
{
    public function getLocaleList(?int $languageId = null, ?int $themeId = null, ?Collection $points = null): Collection;
}
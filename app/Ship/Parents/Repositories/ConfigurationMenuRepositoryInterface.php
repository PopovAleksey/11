<?php

namespace App\Ship\Parents\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ConfigurationMenuRepositoryInterface
{
    public function getLinkDataOfMenuItems(int $languageId, int $themeId): Collection|array;

    public function getPossibleMenuItems(): Collection|array;
}
<?php

namespace App\Ship\Parents\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ConfigurationMenuRepositoryInterface
{
    public function getLinkDataOfMenuItems(int $languageId): Collection|array;
}
<?php

namespace App\Ship\Parents\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ConfigurationMenuRepositoryInterface
{
    public function getLinkNameOfMenuItems(int $languageId): Collection|array;
}
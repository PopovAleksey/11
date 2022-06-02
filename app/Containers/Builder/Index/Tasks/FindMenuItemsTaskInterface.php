<?php

namespace App\Containers\Builder\Index\Tasks;

use Illuminate\Support\Collection;

interface FindMenuItemsTaskInterface
{
    public function run(int $languageId, int $themeId, array|Collection $menuIds): Collection;
}
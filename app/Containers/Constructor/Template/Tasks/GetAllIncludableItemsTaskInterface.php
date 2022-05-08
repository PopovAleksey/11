<?php

namespace App\Containers\Constructor\Template\Tasks;

use Illuminate\Support\Collection;

interface GetAllIncludableItemsTaskInterface
{
    public function run(int $themeId): Collection;
}
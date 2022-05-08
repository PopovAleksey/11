<?php

namespace App\Containers\Constructor\Template\Actions;

use Illuminate\Support\Collection;

interface GetAllIncludableItemsActionInterface
{
    public function run(int $themeId): Collection;
}
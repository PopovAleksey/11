<?php

namespace App\Containers\Dashboard\Content\Actions;

use Illuminate\Support\Collection;

interface GetAllContentActionInterface
{
    public function run(int $pageId): Collection;
}
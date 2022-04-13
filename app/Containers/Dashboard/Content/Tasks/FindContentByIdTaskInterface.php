<?php

namespace App\Containers\Dashboard\Content\Tasks;

use Illuminate\Support\Collection;

interface FindContentByIdTaskInterface
{
    public function run(int $pageId): Collection;
}
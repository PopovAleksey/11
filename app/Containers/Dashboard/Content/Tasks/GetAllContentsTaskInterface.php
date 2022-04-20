<?php

namespace App\Containers\Dashboard\Content\Tasks;

use Illuminate\Support\Collection;

interface GetAllContentsTaskInterface
{
    public function run(int $pageId): Collection;
}
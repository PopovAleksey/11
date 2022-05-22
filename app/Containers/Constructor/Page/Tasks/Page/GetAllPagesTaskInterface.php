<?php

namespace App\Containers\Constructor\Page\Tasks\Page;

use Illuminate\Support\Collection;

interface GetAllPagesTaskInterface
{
    public function run(bool $withFields = false): Collection;
}
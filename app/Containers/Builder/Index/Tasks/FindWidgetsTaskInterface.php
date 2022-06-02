<?php

namespace App\Containers\Builder\Index\Tasks;

use Illuminate\Support\Collection;

interface FindWidgetsTaskInterface
{
    public function run(int $languageId, Collection $widgetsIds): Collection;
}
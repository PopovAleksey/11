<?php

namespace App\Containers\Builder\Index\Tasks;

use Illuminate\Support\Collection;

interface FindLocalizationTaskInterface
{
    public function run(Collection $localizationPoints): Collection;
}